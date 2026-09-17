@extends('layouts.app')
@section('title', 'OTP Verify — DevConnect')
@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    const otpSendUrl = "{{ route('otp.send') }}";
    const otpEmail = "{{$email}}";
    const tocken = "{{ csrf_token()}}";
</script>
<script src="{{ asset('js/otp.js') }}"></script>

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<div class="otp-wrapper">
    <div class="otp-card">

        <!-- Logo -->
        <div class="otp-logo">
            <i class="bi bi-code-slash"></i>
        </div>

        <h2 class="otp-title">Verify Your Email</h2>
        <p class="otp-subtitle">
            We’ll send a 6-digit code to<br>
            <strong>{{ $email ?? 'your email' }}</strong>
        </p>

        <!-- ===== SEND OTP BUTTON (pehle yeh dikhega) ===== -->
        <div id="sendOtpSection">
            <button type="button" class="btn btn-verify w-100" id="sendOtpBtn">
                Send OTP
            </button>

            <!-- Success message (pehle hidden) -->
            <div id="otpSentMessage" class="otp-sent-message" style="display: none;">
                <i class="bi bi-check-circle-fill me-2"></i>
                OTP sent successfully!
            </div>
        </div>

        <!-- ===== OTP FORM (pehle hidden rahega) ===== -->
        <div id="otpFormSection" style="display: none;">
            <form id="otpForm" method="POST" action="{{route('otp.verify')}}">
                @csrf
                <div class="otp-inputs mb-4">
                    <input type="text" name="otp[]" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code">
                    <input type="text" name="otp[]" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" name="otp[]" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" name="otp[]" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" name="otp[]" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*">
                    <input type="text" name="otp[]" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*">
                </div>

                <button type="submit" class="btn btn-verify w-100" id="verifyBtn">
                    Verify OTP
                </button>
            </form>

            <p class="resend-text mt-4 mb-0">
                Didn’t receive the code?
                <a href="javascript:void(0)" id="resendLink">Resend</a>
                <span id="countdown" class="text-muted ms-1"></span>
            </p>
        </div>

        <!-- Success Animation -->
        <div class="success-animation" id="successAnimation">
            <div class="checkmark-circle">
                <div class="checkmark"></div>
            </div>
            <h4 class="mt-3 mb-1 text-black">Verified Successfully!</h4>
            <p class="text-muted">Redirecting you manage password page...</p>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
   .otp-sent-message {
    display: none !important;          /* default hidden */
    background: #ECFDF5 !important;
    color: #065F46 !important;
    border: 1px solid #A7F3D0;
    border-radius: 12px;
    padding: 14px 18px;
    font-weight: 600;
    font-size: 0.95rem;
    text-align: center;
    margin-top: 12px;
}
.otp-sent-message.show-message {
    display: flex !important;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.4s ease;
}
    .otp-wrapper {
        margin-top: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .otp-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 48px 40px;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 20px 50px rgba(79, 70, 229, 0.12);
        text-align: center;
        position: relative;
    }

    .otp-logo {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #4F46E5, #7C3AED);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: #fff;
        font-size: 28px;
    }

    .otp-title {
        font-size: 1.55rem;
        font-weight: 700;
        color: #1E1B4B;
        margin-bottom: 8px;
    }

    .otp-subtitle {
        color: #6B7280;
        font-size: 0.95rem;
        margin-bottom: 32px;
        line-height: 1.5;
    }

    .otp-inputs {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .otp-input {
        width: 52px;
        height: 58px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        text-align: center;
        font-size: 1.4rem;
        font-weight: 600;
        color: #1E1B4B;
        transition: all 0.2s;
    }

    .otp-input:focus {
        outline: none;
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
    }

    .btn-verify {
        background: linear-gradient(135deg, #4F46E5, #7C3AED);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 14px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .btn-verify:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: #fff;
    }

    .resend-text {
        font-size: 0.9rem;
        color: #6B7280;
    }

    .resend-text a {
        color: #4F46E5;
        font-weight: 600;
        text-decoration: none;
    }

    .success-animation {
        display: none;
        position: absolute;
        inset: 0;
        background: #fff;
        border-radius: 24px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .success-animation.show {
        display: flex;
        animation: fadeIn 0.4s ease;
    }

    .checkmark-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #10B981;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: scaleIn 0.4s ease;
    }

    .checkmark {
        width: 28px;
        height: 16px;
        border-left: 4px solid #fff;
        border-bottom: 4px solid #fff;
        transform: rotate(-45deg);
        margin-top: -4px;
        animation: checkDraw 0.3s ease 0.2s forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes checkDraw {
        to {
            opacity: 1;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.otp-input');
        const form = document.getElementById('otpForm');
        const successAnimation = document.getElementById('successAnimation');

        // Send OTP button click
       

        // Auto move to next input
        inputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Form submit → success animation
        // form.addEventListener('submit', function(e) {
        //     e.preventDefault(); // testing ke liye

        //     successAnimation.classList.add('show');

        //     setTimeout(() => {
        //         window.location.href = ""; // apna dashboard route
        //     }, 2000);
        // });
    });
</script>
@endpush