{{-- =========================================================================
     DevConnect — Payment Page
     Dark theme · Glassmorphism · Purple + Blue gradients
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'Checkout — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .payment-page {
        padding: 110px 0 100px;
    }

    .payment-page .page-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .payment-page .page-title .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        color: #c4b5fd;
        margin-bottom: 14px;
    }

    .payment-page .page-title h1 {
        font-size: clamp(1.8rem, 4vw, 2.4rem);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .payment-page .page-title p {
        color: #94a3b8;
        font-size: 0.95rem;
    }

    /* Cards */
    .pay-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 18px;
        padding: 28px;
        backdrop-filter: blur(12px);
    }

    .pay-card h3 {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pay-card h3 i {
        color: #a78bfa;
    }

    /* Form */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 500;
        color: #94a3b8;
        margin-bottom: 7px;
    }

    .form-control-dark {
        width: 100%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 12px;
        padding: 12px 16px;
        color: #e2e8f0;
        font-size: 0.95rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }



    .form-control-dark::placeholder {
        color: #64748b;
    }

    .card-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .card-icons {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .card-icons span {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.8rem;
        color: #cbd5e1;
        font-weight: 600;
    }

    /* Order Summary */
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 0.95rem;
        color: #cbd5e1;
    }

    .summary-row.total {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 10px;
        padding-top: 16px;
        font-size: 1.15rem;
        font-weight: 700;
        color: #e2e8f0;
    }

    .summary-row .price {
        color: #a78bfa;
        font-weight: 600;
    }

    .plan-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(37, 99, 235, 0.2));
        border: 1px solid rgba(139, 92, 246, 0.35);
        color: #c4b5fd;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .secure-note {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 16px;
        font-size: 0.8rem;
        color: #64748b;
    }

    .secure-note i {
        color: #4ade80;
    }

    .btn-pay {
        width: 100%;
        margin-top: 8px;
        padding: 14px;
        font-size: 1rem;
        font-weight: 600;
    }

    .pay-method-btn {
        flex: 1;
        min-width: 100px;
        padding: 10px 14px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        background: rgba(255, 255, 255, 0.04);
        color: #94a3b8;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .pay-method-btn:hover {
        border-color: rgba(139, 92, 246, 0.4);
        color: #c4b5fd;
    }

    .pay-method-btn.active {
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.25), rgba(37, 99, 235, 0.2));
        border-color: rgba(139, 92, 246, 0.5);
        color: #e2e8f0;
    }

    .upi-app {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.8rem;
        color: #cbd5e1;
        font-weight: 500;
    }

    .qr-box {
        display: flex;
        justify-content: center;
        padding: 16px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px dashed rgba(255, 255, 255, 0.15);
        border-radius: 14px;
    }

    .shake-input {
        animation: shakeEffect 0.3s ease-in-out;
        border-color: #ef4444 !important;
        box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);
    }

    @keyframes shakeEffect {

        0%,
        100% {
            transform: translateX(0);
        }

        20%,
        60% {
            transform: translateX(-6px);
        }

        40%,
        80% {
            transform: translateX(6px);
        }
    }
</style>
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main class="payment-page">
    <div class="container-xl">

        {{-- Title --}}
        <div class="page-title">
            <span class="eyebrow">
                <i class="fa-solid fa-lock"></i> Secure Checkout
            </span>
            <h1>Complete your <span class="text-gradient">payment</span></h1>
            <p>Enter your card details to upgrade your plan</p>
        </div>

        <div class="row g-4 justify-content-center">

            {{-- Left: Card Form --}}
            {{-- Left: Payment Methods --}}
            <div class="col-lg-6">
                <div class="pay-card">

                    {{-- Method Tabs --}}
                    <div class="pay-methods" style="display:flex;gap:10px;margin-bottom:24px;flex-wrap:wrap;">
                        <button type="button" class="pay-method-btn active" data-method="card" onclick="switchPayMethod('card')">
                            <i class="fa-solid fa-credit-card"></i> Card
                        </button>
                        <button type="button" class="pay-method-btn" data-method="upi" onclick="switchPayMethod('upi')">
                            <i class="fa-solid fa-mobile-screen"></i> UPI
                        </button>
                        <button type="button" class="pay-method-btn" data-method="qr" onclick="switchPayMethod('qr')">
                            <i class="fa-solid fa-qrcode"></i> QR Code
                        </button>
                    </div>

                    {{-- ========== CARD ========== --}}
                    <div id="method-card" class="pay-method-panel">
                        <h3><i class="fa-solid fa-credit-card"></i> Card Details</h3>

                        <div class="card-icons">
                            <span id="icon-visa" style="opacity: 0.3; transition: 0.3s; font-weight: bold; margin-right: 10px;">VISA</span>
                            <span id="icon-mastercard" style="opacity: 0.3; transition: 0.3s; font-weight: bold; margin-right: 10px;">Mastercard</span>
                            <span id="icon-amex" style="opacity: 0.3; transition: 0.3s; font-weight: bold; margin-right: 10px;">AmericanExpress</span>
                            <span id="icon-rupay" style="opacity: 0.3; transition: 0.3s; font-weight: bold; margin-right: 10px;">RuPay</span>
                        </div>

                        <form action="{{ route('payment.process') }}" method="POST" id="form-card">
                            @csrf
                            <input type="hidden" name="plan" value="{{ request('plan', 'pro') }}">
                            <input type="hidden" name="billing" value="{{ request('billing', 'monthly') }}">
                            <input type="hidden" name="payment_method" value="card">

                            <div class="form-group">
                                <label for="card_name">Name on Card</label>
                                <input type="text" id="card_name" name="card_name" class="form-control-dark"
                                    placeholder="John Doe" required autocomplete="cc-name">
                            </div>

                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input type="text" id="card_number" name="card_number" class="form-control-dark"
                                    placeholder="ACCT-000003" maxlength="19" required
                                    autocomplete="cc-number" inputmode="numeric">
                            </div>

                            <div class="card-row">
                                <div class="form-group">
                                    <label for="card_expiry">Expiry Date</label>
                                    <input type="text" id="card_expiry" name="card_expiry" class="form-control-dark "
                                        placeholder="MM / YY" maxlength="7" required autocomplete="cc-exp">
                                </div>
                                <div class="form-group">
                                    <label for="card_cvv">CVV</label>
                                    <input type="text" id="card_cvv" name="card_cvv" class="form-control-dark"
                                        placeholder="123" maxlength="4" required autocomplete="cc-csc" inputmode="numeric">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient btn-pay">
                                <i class="fa-solid fa-lock"></i> Pay Securely
                            </button>
                        </form>
                    </div>

                    {{-- ========== UPI ========== --}}
                    <div id="method-upi" class="pay-method-panel" style="display:none;">
                        <h3><i class="fa-solid fa-mobile-screen"></i> Pay with UPI</h3>
                        <p style="color:#94a3b8;font-size:0.9rem;margin-bottom:18px;">
                            Enter your UPI ID and approve the payment request on your app.
                        </p>

                        <form id="form-upi" action="{{ route('payment.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" value="{{ request('plan', 'pro') }}">
                            <input type="hidden" name="billing" value="{{ request('billing', 'monthly') }}">
                            <input type="hidden" name="payment_method" value="upi">

                            <div class="form-group">
                                <label for="upi_id">UPI ID</label>
                                <input type="text" id="upi_id" name="upi_id" class="form-control-dark"
                                    placeholder="yourname@upi" required>
                            </div>

                            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:18px;">
                                <span class="upi-app"><i class="fa-brands fa-google-pay"></i> GPay</span>
                                <span class="upi-app"><i class="fa-solid fa-phone"></i> PhonePe</span>
                                <span class="upi-app"><i class="fa-solid fa-building-columns"></i> Paytm</span>
                                <span class="upi-app"><i class="fa-solid fa-indian-rupee-sign"></i> BHIM</span>
                            </div>

                            <button type="submit" class="btn btn-gradient btn-pay">
                                <i class="fa-solid fa-paper-plane"></i> Pay via UPI
                            </button>
                        </form>
                    </div>

                    {{-- ========== QR CODE ========== --}}
                    <div id="method-qr" class="pay-method-panel" style="display:none;">
                        <h3><i class="fa-solid fa-qrcode"></i> Scan QR Code</h3>
                        <p style="color:#94a3b8;font-size:0.9rem;margin-bottom:18px;text-align:center;">
                            Open any UPI app and scan this QR to pay
                        </p>

                        <div id="qrDisplayArea" class="qr-box" style="display: none; justify-content: center; align-items: center; min-height: 200px; flex-direction: column; gap: 12px;">
                            {{ $qrCode }}
                            <div id="qrTimer" style="color:#a78bfa;font-size:0.9rem;font-weight:600;">
                                <i class="fa-regular fa-clock"></i> <span id="qrTimerText">01:00</span>
                            </div>
                        </div>

                        <button id="toggleQrBtn" class="btn btn-ghost btn-pay" onclick="toggleQRCode()" style="margin-top: 10px;">
                            <i class="fa-solid fa-eye"></i> Show QR Code
                        </button>

                        <p style="text-align:center;color:#94a3b8;font-size:0.85rem;margin-top:14px;">
                            Amount: <strong style="color:#a78bfa;" id="qrAmount">$12.00</strong>
                        </p>
                        <form action="{{ route('payment.process') }}" method="POST" id="form-qr" style="margin-top:18px;">
                            @csrf
                            <input type="hidden" name="plan" value="{{ request('plan', 'pro') }}">
                            <input type="hidden" name="billing" value="{{ request('billing', 'monthly') }}">
                            <input type="hidden" name="payment_method" value="qr">
                            <button type="submit" class="btn btn-gradient btn-pay">
                                <i class="fa-solid fa-check"></i> I have paid
                            </button>
                        </form>
                    </div>

                    <div class="secure-note">
                        <i class="fa-solid fa-shield-halved"></i>
                        Your payment is encrypted and secure. We never store full card details.
                    </div>
                </div>
            </div>

            {{-- Right: Order Summary --}}
            <div class="col-lg-4">
                <div class="pay-card">
                    <h3><i class="fa-solid fa-receipt"></i> Order Summary</h3>

                    <span class="plan-badge" id="planBadge">Pro Plan</span>

                    <div class="summary-row">
                        <span>Plan</span>
                        <span id="summaryPlan">Pro</span>
                    </div>
                    <div class="summary-row">
                        <span>Billing</span>
                        <span id="summaryBilling">Monthly</span>
                    </div>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="price" id="summarySubtotal">$12.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="price" id="summaryTotal">$12.00</span>
                    </div>

                    <p id="terms-disclaimer" style="margin-top:20px;font-size:0.8rem;color:#64748b;line-height:1.5;">
                        By completing this purchase you agree to our
                        <a href="{{ url('/terms') }}" style="color:#a78bfa;">Terms of Service</a>.
                        You can cancel anytime from your account settings.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cloudflare.com"></script>

<script>
    // ajax script for sending form fata in to payment controller 
    // Update summary from URL params

    $(document).ready(function() {

        function checkLuhn(cardNumber) {
            let cleanNumber = cardNumber.replace(/\D/g, '');
            let length = cleanNumber.length;

            if (length < 13 || length > 19) {
                return false;
            }

            let sum = 0;
            let shouldDouble = false;

            for (let i = length - 1; i >= 0; i--) {
                let digit = parseInt(cleanNumber.charAt(i));

                if (shouldDouble) {
                    digit *= 2;
                    if (digit > 9) {
                        digit -= 9;
                    }
                }

                sum += digit;
                shouldDouble = !shouldDouble;
            }

            return (sum % 10 === 0);
        }

        function detectCardType(number) {
            let cleanNumber = number.replace(/\D/g, '');

            $('.card-icons span').css('opacity', '0.3').css('color', '');

            if (cleanNumber.startsWith('4')) {
                $('#icon-visa').css('opacity', '1').css('color', '#00579f'); // Visa Blue
            } else if (/^(5[1-5]|2[2-7])/.test(cleanNumber)) {
                $('#icon-mastercard').css('opacity', '1').css('color', '#ff5f00'); // Mastercard Orange
            } else if (/^(34|37)/.test(cleanNumber)) {
                $('#icon-amex').css('opacity', '1').css('color', '#017ccc'); // Amex Cyan
            } else if (/^(60|65|81|82)/.test(cleanNumber)) {
                $('#icon-rupay').css('opacity', '1').css('color', '#1d4ed8'); // RuPay Blue
            }
        }

        $('#card_number').on('input', function() {
            let val = $(this).val();
            let cleanVal = val.replace(/\D/g, '');
            let $submitBtn = $('#form-card button[type="submit"]');

            let formatted = val.replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim();
            $(this).val(formatted);

            detectCardType(cleanVal);

            $(this).removeClass('shake-input');

            if (cleanVal.length === 0) {
                $(this).css('border-color', '');
                $submitBtn.prop('disabled', false);
                return;
            }

            if (cleanVal.length >= 16) {
                if (checkLuhn(cleanVal)) {
                    $(this).css('border-color', '#10b981');
                    $submitBtn.prop('disabled', false); // button clickable
                } else {

                    // field wrong होने पर shake क्लास जुड़ जाएगी
                    $(this).addClass('shake-input');
                    $submitBtn.prop('disabled', true); // button lock
                }
            } else if (cleanVal.length >= 13 && cleanVal.length < 16) {
                if (checkLuhn(cleanVal)) {
                    $(this).css('border-color', '#10b981');
                    $submitBtn.prop('disabled', false);
                } else {
                    $submitBtn.prop('disabled', true);
                }
            } else {
                $(this).css('border-color', '#a78bfa');
                $submitBtn.prop('disabled', true);
            }
        });

        // Expiry format
        $('#card_expiry').on('input', function() {
            let $input = $(this);
            let val = $input.val().replace(/\D/g, '');

            $input.removeClass('shake-input').css('border-color', '');
            if (val.length > 4) {
                val = val.substring(0, 4);
            }
            let formattedVal = val;
            if (val.length >= 3) {
                formattedVal = val.substring(0, 2) + ' / ' + val.substring(2);
            }
            $input.val(formattedVal);

            if (val.length === 4) {
                let month = parseInt(val.substring(0, 2), 10);
                let year = parseInt(val.substring(2, 4), 10);

                let currentYear = 26;
                let currentMonth = 7;

                let isInvalid = false;

                if (month < 1 || month > 12) {
                    isInvalid = true;
                } else if (year < currentYear) {
                    isInvalid = true;
                } else if (year === currentYear && month < currentMonth) {
                    isInvalid = true;
                }

                if (isInvalid) {
                    $input.addClass('shake-input');
                    $('#form-card button[type="submit"]').prop('disabled', true);
                } else {
                    $input.css('border-color', '#10b981');
                    $('#form-card button[type="submit"]').prop('disabled', false);
                }
            }


        });
        // CVV only digits
        $('#card_cvv').on('input', function() {
            $(this).val($(this).val().replace(/\D/g, '').substring(0, 4));

        });
        // ajax for submit form data 
        $('#form-card, #form-upi, #form-qr').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $btn = $form.find('button[type="submit"]');
            const originalHTMl = $btn.html();
            // disable button and loading 
            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Processing...');

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    'Accept': 'application/json'
                },
                success: function(res) {
                    if (res.success && res.redirect) {
                        // Optional toast
                        console.log(res);
                        $btn.html('<i class="fa-solid fa-check"></i> Success!');
                        setTimeout(function() {
                            window.location.href = res.redirect;
                        }, 600);
                    } else {
                        alert(res.message || 'Something went wrong');
                        $btn.prop('disabled', false).html(originalHtml);
                    }
                },
                error: function(xhr) {
                    let msg = 'Payment failed. Please try again.';

                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        msg = Object.values(errors).flat().join('\n');
                    } else if (xhr.responseJSON?.message) {
                        msg = xhr.responseJSON.message;
                    }

                    alert(msg);
                    $btn.prop('disabled', false).html(originalHtml);
                }
            });
        });


        const urlParams = new URLSearchParams(window.location.search);
        const planType = urlParams.get('plan');
        const billingCycle = urlParams.get('billing');
        const amountValue = urlParams.get('amount');
        const billingValue = 8;
        console.log(planType);
        console.log(billingCycle);
        console.log(amountValue);

        $('planBadge').text('planType');
        $('#summaryPlan').text(planType);
        $('#planBadge').text(planType);
        $('#summarySubtotal').text('$' + amountValue);
        $('#summaryBilling').text(billingCycle);
        $('#summaryTotal').text('$' + amountValue);
        $('#qrAmount').text('$' + amountValue);

        $('input[name="plan"]').val(planType);
        $('input[name="billing"]').val(billingCycle);
        $('input[name="amount"]').val(amountValue);


        const cleanAmount = Number(amountValue.replace('$', ''));
        console.log(cleanAmount);

        if (Number(cleanAmount) === 0) {
            $('#terms-disclaimer').html(`
    <div style="background-color: #fef3c7; color: #92400e; padding: 10px; border-radius: 6px; margin-bottom: 12px; font-weight: 500;">
        When Your free trial ends. Your payment will start $${billingValue} automatically after 1 month.
    </div>
`);
        }

    });



    function toggleQRCode() {
    const $qrArea = $('#qrDisplayArea');
    const $btn = $('#toggleQrBtn');

    if ($qrArea.is(':hidden')) {
        // Show QR + start 1 min timer
        $qrArea.css('display', 'flex');
        $btn.html('<i class="fa-solid fa-eye-slash"></i> Hide QR Code');
        startQrTimer();
    } else {
        // Hide QR + stop timer
        $qrArea.hide();
        $btn.html('<i class="fa-solid fa-eye"></i> Show QR Code');
        stopQrTimer();
    }
}
         let qrTimerInterval = null;
        let qrSecondsLeft = 60;
// time format function 
        function formatQrTime(sec) {
            const m = String(Math.floor(sec / 60)).padStart(2, '0');
            const s = String(sec % 60).padStart(2, '0');
            return m + ':' + s;
        }
// time stop function 
        function stopQrTimer() {
            if (qrTimerInterval) {
                clearInterval(qrTimerInterval);
                qrTimerInterval = null;
            }
        }
        // time start function 

        function startQrTimer() {
            stopQrTimer();
            qrSecondsLeft = 60;
            $('#qrTimerText').text(formatQrTime(qrSecondsLeft));

            qrTimerInterval = setInterval(function() {
                qrSecondsLeft--;
                $('#qrTimerText').text(formatQrTime(qrSecondsLeft));

                if (qrSecondsLeft <= 0) {
                    stopQrTimer();
                    // Auto hide QR
                    $('#qrDisplayArea').hide();
                    $('#toggleQrBtn').html('<i class="fa-solid fa-eye"></i> Show QR Code');
                }
            }, 1000);
        }


    function switchPayMethod(method) {
        document.querySelectorAll('.pay-method-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.method === method);
        });

        document.querySelectorAll('.pay-method-panel').forEach(panel => {
            panel.style.display = 'none';
        });
        document.getElementById('method-' + method).style.display = 'block';
    }

    // Format card number (spaces every 4 digits)
    const cardNumber = document.getElementById('card_number');
    if (cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '').substring(0, 16);
            let formatted = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = formatted;
        });
    }




    // CVV only numbers
    const cardCvv = document.getElementById('card_cvv');
    if (cardCvv) {
        cardCvv.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }
</script>
@endpush