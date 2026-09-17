@php
    $invoiceData = is_array($invoice) ? $invoice : ($invoice ? $invoice->toArray() : []);
    $invoiceNumber = $invoiceData['invoice_number'] ?? 'N/A';
    $paidAt = $invoiceData['paid_at'] ?? null;
    $status = $invoiceData['status'] ?? 'paid';
    $userName = $invoiceData['user_name'] ?? ($invoiceData['user']['name'] ?? 'Customer');
    $userEmail = $invoiceData['user_email'] ?? ($invoiceData['user']['email'] ?? '');
    $plan = $invoiceData['plan'] ?? 'pro';
    $billing = $invoiceData['billing'] ?? 'monthly';
    $paymentMethod = $invoiceData['payment_method'] ?? 'stripe';
    $amount = (float) ($invoiceData['amount'] ?? 0);
@endphp

@extends('layouts.app')

@section('title', 'Invoice ' . $invoice . ' — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .invoice-page { padding: 110px 0 100px; }
    .invoice-box {
        max-width: 720px;
        margin: 0 auto;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 40px;
        backdrop-filter: blur(12px);
    }
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .invoice-brand { display: flex; align-items: center; gap: 12px; }
    .invoice-brand .logo {
        width: 42px; height: 42px; border-radius: 12px;
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem;
    }
    .invoice-brand h2 { font-size: 1.3rem; font-weight: 700; margin: 0; }
    .invoice-brand h2 span {
        background: linear-gradient(135deg, #a78bfa, #60a5fa);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .invoice-meta { text-align: right; }
    .invoice-meta .label { font-size: 0.8rem; color: #94a3b8; margin-bottom: 4px; }
    .invoice-meta .value { font-size: 1rem; font-weight: 600; color: #e2e8f0; }
    .status-paid {
        display: inline-block;
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
        font-size: 0.75rem; font-weight: 700;
        padding: 4px 12px; border-radius: 50px;
        text-transform: uppercase; letter-spacing: 0.5px; margin-top: 8px;
    }
    .invoice-row {
        display: flex; justify-content: space-between;
        padding: 12px 0; font-size: 0.95rem; color: #cbd5e1;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .invoice-row.total {
        margin-top: 12px; padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.12);
        font-size: 1.2rem; font-weight: 700; color: #e2e8f0;
    }
    .invoice-row .price { color: #a78bfa; font-weight: 600; }
    .invoice-footer {
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 16px; margin-top: 32px; padding-top: 24px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .invoice-footer p { font-size: 0.85rem; color: #64748b; margin: 0; }
    .invoice-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    @media print {
        .navbar, .ambient-bg, .invoice-actions, footer { display: none !important; }
        body { background: #fff; }
        .invoice-box { border: 1px solid #ddd; background: #fff; color: #000; }
    }
</style>
@endpush

@section('content')
<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>
<script src="https://cloudflare.com"></script>
<main class="invoice-page">
    <div class="container-xl">
        <div class="invoice-box">

            <div class="invoice-header">
                <div class="invoice-brand">
                    <div class="logo"><i class="fa-solid fa-code"></i></div>
                    <div>
                        <h2>Dev<span>Connect</span></h2>
                        <p style="font-size:0.8rem;color:#94a3b8;margin:0;">Payment Invoice</p>
                    </div>
                </div>
                <div class="invoice-meta">
                    <div class="label">Invoice</div>
                    <div class="value"> #{{ $invoiceNumber }}</div>
                    <div class="label" style="margin-top:10px;">Date</div>
                    <div class="value">{{ $paidAt ? \Carbon\Carbon::parse($paidAt)->format('d M Y, h:i A') : '—' }}</div>
                    <div class="status-paid"><i class="fa-solid fa-check"></i> {{ ucfirst($status) }}</div>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <div style="font-size:0.8rem;color:#94a3b8;margin-bottom:4px;">Billed To</div>
                <div style="font-weight:600;color:#e2e8f0;">{{ $userName }}</div>
                <div style="font-size:0.85rem;color:#94a3b8;">{{ $userEmail }}</div>
            </div>

            <div>
                <div class="invoice-row">
                    <span>Plan</span>
                    <span>{{ strtoupper($plan) }}</span>
                </div>
                <div class="invoice-row">
                    <span>Billing Cycle</span>
                    <span>{{ ucfirst($billing) }}</span>
                </div>
                <div class="invoice-row">
                    <span>Payment Method</span>
                    <span>{{ strtoupper($paymentMethod) }}</span>
                </div>
                <div class="invoice-row">
                    <span>Subtotal</span>
                    <span class="price">${{ number_format($amount, 2) }}</span>
                </div>
                <div class="invoice-row total">
                    <span>Total Paid</span>
                    <span class="price">${{ number_format($amount, 2) }}</span>
                </div>
            </div>

            <div class="invoice-footer">
                <p>Thank you for upgrading on DevConnect.<br>This is a computer-generated invoice.</p>
                <div class="invoice-actions">
                    <a href="{{ route('invoice.pdf', $invoiceNumber) }}"
   class="btn btn-ghost btn-sm">
    <i class="fa-solid fa-file-pdf"></i> Download PDF
</a>
                    <a href="{{ url('/') }}" class="btn btn-gradient btn-sm">
                        <i class="fa-solid fa-arrow-right"></i> Go to Home
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>
<script>
function downloadExactBladePDF() {
    // Jis section ko PDF banana hai usse select karein
    const element = document.querySelector('.invoice-box');
    
    // Actions button ko hide karne ke liye styles (taki download button PDF me na aaye)
    const actions = document.querySelector('.invoice-actions');
    actions.style.display = 'none';

    // Options configuration
    const opt = {
        margin:       10,
        filename:     'Invoice-{{ $invoiceNumber }}.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, useCORS: true, backgroundColor: '#0f172a' }, // Dark background force karne ke liye
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    // PDF generate aur download karein
    html2pdf().set(opt).from(element).save().then(() => {
        // Download hone ke baad buttons ko wapas screen par dikhayein
        actions.style.display = 'flex';
    });
}
</script>
@endsection