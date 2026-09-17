<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Invoice;
use Carbon\Carbon;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $plan     = $request->query('plan', 'pro');
        $billing  = $request->query('billing', 'monthly');
        $amount   = $request->query('amount', '12.00');
        $qrData = "Plan: $plan, Billing: $billing, Amount: $$amount";
        $qrCode = QrCode::format('svg')->size(200)->generate($qrData);
        return view('payment', compact('qrCode', 'plan', 'billing', 'amount'));
    }

    
    // stripe payment 
public function stripeCheckout(Request $request)
{
    try {

        $request->validate([
            'plan' => 'required|in:pro,team',
            'billing' => 'required|in:monthly,yearly',
        ]);

        $prices = [
            'pro' => [
                'monthly' => 12,
                'yearly' => 20,
            ],
            'team' => [
                'monthly' => 29,
                'yearly' => 45,
            ],
        ];

        $plan = $request->plan;
        $billing = $request->billing;

        $amount = $prices[$plan][$billing];

        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' .
            strtoupper(\Illuminate\Support\Str::random(4));

        $metadata = [
            'user_id' => (string) Auth::id(),
            'plan' => $plan,
            'billing' => $billing,
            'invoice_number' => $invoiceNumber,
        ];

        Log::channel('stripe')->info(
            '========== CHECKOUT BEFORE CREATE ==========',
            [
                'metadata' => $metadata,
            ]
        );

        $stripe = new StripeClient(
            config('services.stripe.secret')
        );

        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'customer_email' => Auth::user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => ucfirst($plan) . ' Membership',
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ],
            ],

            // Checkout Session Metadata
            'metadata' => $metadata,
            // Payment Intent Metadata
            'payment_intent_data' => [
                'metadata' => $metadata,
            ],
            'success_url' => route('stripe.success')
                . '?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('stripe.cancel'),
        ]);

        Log::channel('stripe')->info(
            '========== STRIPE CHECKOUT CREATED ==========',
            [
                'session_id' => $session->id,

                'invoice_number_generated' => $invoiceNumber,

                'metadata_sent' => $metadata,

                'stripe_response_metadata' =>
                    $session->metadata
                        ? $session->metadata->toArray()
                        : null,
            ]
        );

        return redirect()->away($session->url);

    } catch (\Throwable $e) {

        Log::channel('stripe')->error(
            '========== STRIPE CHECKOUT ERROR ==========',
            [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]
        );

        return back()->with(
            'error',
            'Unable to create Stripe checkout.'
        );
    }
}

    //  stripe success 
    public function stripeSuccess(Request $request)
{
    $sessionId = $request->session_id;
    if (!$sessionId) {
        return redirect()
            ->route('pricing')
            ->with('error', 'Invalid Stripe session.');
    }
     $invoice = Invoice::where(
        'stripe_session_id',
        $sessionId
    )
    ->where('user_id', Auth::id())
    ->first();
    return view('invoice', [
        'invoice' => $invoice
    ]);
}
public function stripeWebhook(Request $request)
{
    try {

        Log::channel('stripe')->info(
            '========== STRIPE WEBHOOK HIT ==========',
            [
                'payload' => $request->getContent(),
                'signature' => $request->header('Stripe-Signature'),
            ]
        );

        $payload = $request->getContent();

        $signature = $request->header('Stripe-Signature');

        $endpointSecret = config(
            'services.stripe.webhook_secret'
        );

        $event = \Stripe\Webhook::constructEvent(
            $payload,
            $signature,
            $endpointSecret
        );

        Log::channel('stripe')->info(
            '========== STRIPE EVENT VERIFIED ==========',
            [
                'event_id' => $event->id,
                'event_type' => $event->type,
            ]
        );

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $metadata = $session->metadata ?? null;
            Log::channel('stripe')->info(
                '========== CHECKOUT SESSION RECEIVED ==========',
                [
                    'session_id' => $session->id ?? null,
                    'payment_status' =>
                        $session->payment_status ?? null,
                    'status' =>
                        $session->status ?? null,
                    'metadata' =>
                        $metadata
                            ? $metadata->toArray()
                            : null,
                    'user_id' =>
                        $metadata->user_id ?? null,

                    'plan' =>
                        $metadata->plan ?? null,

                    'billing' =>
                        $metadata->billing ?? null,

                    'invoice_number' =>
                        $metadata->invoice_number ?? null,
                ]
            );

            if (($session->payment_status ?? null) === 'paid') {
                Log::channel('stripe')->info(
                    '========== PAYMENT PAID =========='
                );
                if (
                    !$metadata ||
                    empty($metadata->user_id) ||
                    empty($metadata->plan) ||
                    empty($metadata->billing) ||
                    empty($metadata->invoice_number)
                ) {
                    Log::channel('stripe')->error(
                        '========== STRIPE METADATA MISSING ==========',
                        [
                            'session_id' => $session->id ?? null,

                            'metadata' =>
                                $metadata
                                    ? $metadata->toArray()
                                    : null,
                        ]
                    );

                    return response()->json([
                        'error' => 'Required metadata missing'
                    ], 400);
                }
                Log::channel('stripe')->info(
                    '========== STARTING PAYMENT PROCESS =========='
                );

                $this->processSuccessfulPayment($session);

                Log::channel('stripe')->info(
                    '========== PAYMENT PROCESS FINISHED =========='
                );

            } else {

                Log::channel('stripe')->warning(
                    '========== PAYMENT NOT PAID ==========',
                    [
                        'session_id' => $session->id ?? null,

                        'payment_status' =>
                            $session->payment_status ?? null,
                    ]
                );
            }
        } else {

            Log::channel('stripe')->info(
                '========== STRIPE EVENT NOT HANDLED ==========',
                [
                    'event_type' => $event->type,
                ]
            );
        }


        return response()->json([
            'received' => true
        ]);


    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        Log::channel('stripe')->error(
            '========== STRIPE SIGNATURE ERROR ==========',
            [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]
        );
        return response()->json([
            'error' => 'Invalid signature'
        ], 400);


    } catch (\Throwable $e) {

        Log::channel('stripe')->error(
            '========== STRIPE WEBHOOK ERROR ==========',
            [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]
        );

        return response()->json([
            'error' => 'Webhook processing failed'
        ], 500);
    }
}
private function processSuccessfulPayment($session)
{
    Log::info('processSuccessfulPayment START', [
        'session_id' => $session->id
    ]);
    $metadata = $session->metadata;
    $userId = $metadata->user_id ?? null;
    $plan = $metadata->plan ?? null;
    $billing = $metadata->billing ?? null;
    $invoiceNumber = $metadata->invoice_number ?? null;
    
     if (!$userId || !$plan || !$billing || !$invoiceNumber) {
        Log::error('Required Stripe metadata missing');
        return;
    }
   $this->createInvoice($session);
   $this->activateMembership($session);

}

private function createInvoice($session)
{
    $metadata = $session->metadata;

    $userId = $metadata->user_id ?? null;
    $plan = $metadata->plan ?? null;
    $billing = $metadata->billing ?? null;
    $invoiceNumber = $metadata->invoice_number ?? null;


    if (!$userId || !$plan || !$billing || !$invoiceNumber) {
        return;
    }

    // Duplicate invoice prevent
    $existingInvoice = Invoice::where(
        'stripe_session_id',
        $session->id
    )->first();

    if ($existingInvoice) {
        return;
    }

    $prices = [
        'pro' => [
            'monthly' => 12,
            'yearly' => 20,
        ],
        'team' => [
            'monthly' => 29,
            'yearly' => 45,
        ],
    ];
    $amount = $prices[$plan][$billing] ?? 0;
    Invoice::create([
        'user_id' => $userId,
        'invoice_number' => $invoiceNumber,
        'plan' => $plan,
        'billing' => $billing,
        'amount' => $amount,
        'payment_method' => 'stripe',
        'status' => 'paid',
        'stripe_session_id' => $session->id,
        'stripe_payment_intent' => $session->payment_intent,
        'paid_at' => now(),
    ]);
}

// activate plan 
private function activateMembership($session)
{
    $userId = $session->metadata->user_id ?? null;
    $plan = $session->metadata->plan ?? null;
    $billing = $session->metadata->billing ?? null;
    if (!$userId || !$plan || !$billing) {
        Log::error('Stripe metadata missing', [
            'session_id' => $session->id,
        ]);
        return;
    }
    $user = User::find($userId);
    if (!$user) {
        Log::error('Stripe user not found', [
            'user_id' => $userId,
        ]);
        return;
    }
    if ($billing === 'monthly') {
        $expiryDate = now()->addDays(5);
    } else {
        $expiryDate = now()->addDays(10);
    }
    $user->update([
        'plan' => $plan,
        'membership_status' => 1,
        'membership_expiry' => $expiryDate,
    ]);
    
}
// stripe cancel 
public function stripeCancel()
{
    return redirect()
        ->route('pricing')
        ->with('error', 'Payment cancelled.');
}

    public function showInvoice(string $invoice)
    {
        $data = session('last_invoice');

        // Agar session empty ya number match nahi
        if (!$data || $data['invoice_number'] !== $invoice) {
            abort(404, 'Invoice not found');
        }
        return view('invoice', ['invoice' => $data]);
    }


    public function downloadPdf(string $invoice)
    {
        $invoiceData = Invoice::where('invoice_number', $invoice)->with('user')->firstOrFail();
        $pdf = Pdf::loadView('pdfinvoice', ['invoice' => $invoiceData]);

        return $pdf->download($invoiceData->invoice_number . '.pdf');
    }
}
