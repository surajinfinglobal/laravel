<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Models\User;
use App\Models\Invoice;
use Carbon\Carbon;
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

    public function process(Request $request)
    {
        $request->validate([
            'plan'           => 'required|in:free,pro,team',
            'billing'        => 'required|in:monthly,yearly',
            'payment_method' => 'required|in:card,upi,qr',

            'card_name'      => 'required_if:payment_method,card|max:100',
            'card_number'    => 'required_if:payment_method,card|max:25',
            'card_expiry'    => 'required_if:payment_method,card|max:10',
            'card_cvv'       => 'required_if:payment_method,card|max:4',

            'upi_id'         => 'required_if:payment_method,upi|max:100',
        ]);
        $prices = [
            'pro'  => ['monthly' => 12, 'yearly' => 20],
            'team' => ['monthly' => 29, 'yearly' => 45],
            'free' => ['monthly' => 0,  'yearly' => 0],
        ];
        $plan    = $request->plan;
        $billing = $request->billing;
        $amount  = $prices[$plan][$billing] ?? 0;

        if ($plan == 'free') {
            $membershipStatus = 0;
            $expiryDate = null;
        } else {

            $membershipStatus = 1;

            if ($billing == 'monthly') {
                $expiryDate = Carbon::now()->addDays(2);
            } else {
                $expiryDate = Carbon::now()->addDays(10);
            }
        }



        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));

        $invoice = [
            'invoice_number' => $invoiceNumber,
            'user_id'    => Auth::id(),
            'user_name'  => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'plan'           => $plan,
            'billing'        => $billing,
            'amount'         => $amount,
            'payment_method' => $request->payment_method,
            'status'         => 'paid',
            'paid_at'        => now()->toDateTimeString(),
        ];
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'plan' => $plan,
            'membership_status' => $membershipStatus,
            'membership_expiry' => $expiryDate,
        ]);
        Invoice::create([

            'user_id' => Auth::id(),
            'invoice_number' => $invoiceNumber,
            'plan' => $plan,
            'billing' => $billing,
            'amount' => $amount,
            'payment_method' => $request->payment_method,
            'status' => 'paid',
            'paid_at' => now(),

        ]);
        session(['last_invoice' => $invoice]);
        // user ko email bhejne ke liye 
        Mail::to(Auth::user()->email)->send(new InvoiceMail($invoice));
        // ajax ko request return karna 
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Payment successful',
                'invoice'  => $invoiceNumber,
                'redirect' => route('invoice.show', $invoiceNumber),
            ]);
        }
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
