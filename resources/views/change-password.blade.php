@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/passwords.js') }}"></script>

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<div class="change-password-wrapper">
    <div class="change-password-card">

        <!-- Logo -->
        <div class="cp-logo">
            <i class="bi bi-shield-lock"></i>
        </div>

        <h2 class="cp-title" id="formTitle">Change Password</h2>
        <p class="cp-subtitle" id="formSubtitle">Create a strong new password for your account</p>

        <!-- ========== NORMAL CHANGE PASSWORD FORM ========== -->
         <!-- Success Message (dono forms ke liye common) -->
        <div id="successMessage" class="success-message" style="display: none;">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>
            <h4 class="mt-3 mb-1 text-dark">Password Changed Successfully!</h4>
            <p class="text-muted mb-0">Your password has been updated.</p>
        </div>
        <!-- Error Message Box -->
            <div id="errorMessage" class="error-message" style="display: none;">
                <i class="bi bi-exclamation-circle me-2"></i>
                <span id="errorText"></span>
            </div>
        <form method="POST" action="{{ route('password.update.current') }}" id="changePasswordForm">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div class="mb-3 text-start">
                <label class="form-label">Current Password</label>
                <div class="input-group">
                    <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                    
                </div>
                    <div class="field-error" id="current_password_error"></div>
                
            </div>

            <!-- New Password -->
            <div class="mb-3 text-start">
                <label class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                 <div class="field-error" id="password_error"></div>

            </div>

            <!-- Confirm Password -->
            <div class="mb-3 text-start">
                <label class="form-label">Confirm New Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
        <div class="field-error" id="password_confirmation_error"></div>
            </div>

            <!-- Password Strength -->
            <div class="password-strength mb-4">
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
                <small class="strength-text" id="strengthText">Password strength</small>
            </div>

            <button type="submit" class="btn btn-change-password w-100">
                Update Password
            </button>

            <!-- Forgot Password Link -->
            <div class="mt-3">
                <a href="javascript:void(0)" id="forgotPasswordLink" class="forgot-link">
                    Forgot Password?
                </a>
            </div>
        </form>

        <!-- ========== FORGOT PASSWORD FORM (hidden by default) ========== -->
        <form method="POST" action="" id="forgotPasswordForm" style="display: none;">
            @csrf

            <!-- New Password -->
            <div class="mb-3 text-start">
                <label class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="forgotPassword" class="form-control" placeholder="Enter new password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4 text-start">
                <label class="form-label">Confirm New Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-change-password w-100">
                Reset Password
            </button>

            <!-- Back to Change Password -->
            <div class="mt-3">
                <a href="javascript:void(0)" id="backToChangeLink" class="forgot-link">
                    ← Back to Change Password
                </a>
            </div>
        </form>

        <a href="" class="back-link mt-4 d-inline-block">
            <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
        </a>

    </div>
</div>
@endsection

@push('styles')
<style>
    .field-error {
    color: #ff6b6b;
    font-size: 13px;
    margin-top: 6px;
}

    .error-message {
    background: #FEF2F2;
    color: #991B1B;
    border: 1px solid #FECACA;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    animation: fadeIn 0.3s ease;
}
    .success-message {
    text-align: center;
    padding: 20px 10px;
    animation: fadeIn 0.4s ease;
}

.success-icon {
    width: 70px;
    height: 70px;
    background: #10B981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: #fff;
    font-size: 32px;
    animation: scaleIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { transform: scale(0.5); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
    .change-password-wrapper {
        margin-top: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .change-password-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 48px 40px;
        width: 100%;
        max-width: 460px;
        box-shadow: 0 20px 50px rgba(79, 70, 229, 0.12);
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .cp-logo {
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

    .cp-title {
        font-size: 1.55rem;
        font-weight: 700;
        color: #1E1B4B;
        margin-bottom: 8px;
    }

    .cp-subtitle {
        color: #6B7280;
        font-size: 0.95rem;
        margin-bottom: 32px;
    }

    .form-label {
        font-weight: 500;
        color: #374151;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 12px 0 0 12px;
        padding: 12px 16px;
        border: 2px solid #E5E7EB;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
    }

    .input-group .btn {
        border-radius: 0 12px 12px 0;
        border: 2px solid #E5E7EB;
        border-left: none;
        background: #fff;
        color: #6B7280;
    }

    .btn-change-password {
        background: linear-gradient(135deg, #4F46E5, #7C3AED);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 14px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .btn-change-password:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: #fff;
    }

    .forgot-link {
        color: #4F46E5;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .back-link {
        color: #6B7280;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .password-strength {
        text-align: left;
    }

    .strength-bar {
        height: 6px;
        background: #E5E7EB;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 6px;
    }

    .strength-fill {
        height: 100%;
        width: 0;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .strength-text {
        color: #6B7280;
        font-size: 0.8rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const changeForm = document.getElementById('changePasswordForm');
    const forgotForm = document.getElementById('forgotPasswordForm');
    const formTitle = document.getElementById('formTitle');
    const formSubtitle = document.getElementById('formSubtitle');
    const forgotLink = document.getElementById('forgotPasswordLink');
    const backLink = document.getElementById('backToChangeLink');

    // Show Forgot Password Form
    forgotLink.addEventListener('click', function () {
        changeForm.style.display = 'none';
        forgotForm.style.display = 'block';
        formTitle.textContent = 'Reset Password';
        formSubtitle.textContent = 'Enter your new password below';
    });

    // Back to Change Password Form
    backLink.addEventListener('click', function () {
        forgotForm.style.display = 'none';
        changeForm.style.display = 'block';
        formTitle.textContent = 'Change Password';
        formSubtitle.textContent = 'Create a strong new password for your account';
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });

    // Password strength
    const passwordInput = document.getElementById('password');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');

    if (passwordInput) {
        passwordInput.addEventListener('input', function () {
            const val = this.value;
            let strength = 0;

            if (val.length >= 8) strength += 25;
            if (/[A-Z]/.test(val)) strength += 25;
            if (/[0-9]/.test(val)) strength += 25;
            if (/[^A-Za-z0-9]/.test(val)) strength += 25;

            strengthFill.style.width = strength + '%';

            if (strength <= 25) {
                strengthFill.style.background = '#EF4444';
                strengthText.textContent = 'Weak password';
            } else if (strength <= 50) {
                strengthFill.style.background = '#F59E0B';
                strengthText.textContent = 'Fair password';
            } else if (strength <= 75) {
                strengthFill.style.background = '#3B82F6';
                strengthText.textContent = 'Good password';
            } else {
                strengthFill.style.background = '#10B981';
                strengthText.textContent = 'Strong password';
            }
        });
    }
});
</script>
@endpush