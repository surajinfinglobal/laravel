{{-- =========================================================================
     DevConnect — Login Page
     ========================================================================= --}}
@extends('layouts.app')


@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<nav class="auth-nav">
    <div class="container-xl">
        <a href="{{ url('/') }}" class="brand">
            <span>&nbsp;</span>
        </a>
        <a href="{{ url('/') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Back to Home
        </a>
    </div>
</nav>

<main class="auth-wrapper">
    <div class="container-xl">
        <div class="auth-grid reveal in-view">

            {{-- Left branding / visual panel --}}
            <div class="auth-visual-panel">
                <div class="auth-visual-brand">
                    <span class="brand-mark"><i class="fa-solid fa-code"></i></span>
                    <span>DevConnect</span>
                </div>

                <div class="auth-visual-quote">
                    <i class="fa-solid fa-quote-left"></i>
                    <p>"DevConnect helped me land three freelance gigs. The rating system gives my projects real credibility."</p>
                    <div class="quote-person">Liam Johnson — Frontend Developer</div>
                </div>

                <div class="auth-visual-stats">
                    <div><strong>12.4k+</strong><span>Developers</span></div>
                    <div><strong>8.6k+</strong><span>Projects</span></div>
                    <div><strong>4.9</strong><span>Avg Rating</span></div>
                </div>
            </div>

            {{-- Right form panel --}}
            <div class="auth-form-panel">
                <h1 class="auth-heading">Welcome back</h1>
                <p class="auth-subtext">Log in to continue building your portfolio. New here? <a href="{{ route('signup') }}">
                Create Account
            </a></p>

                @if (session('status'))
                    <div class="auth-alert success">
                        <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="auth-alert">
                        <i class="fa-solid fa-circle-exclamation"></i> These credentials do not match our records.
                    </div>
                @endif

                <div class="social-auth-row">
                    <a href="{{ url('/auth/github') }}" class="btn-social social-github">
                        <i class="fa-brands fa-github"></i> GitHub
                    </a>
                    <a href="{{ url('/auth/google') }}" class="btn-social social-google">
                        <i class="fa-brands fa-google"></i> Google
                    </a>
                </div>

                <div class="divider-row">
                    <span class="line"></span>
                    <span>or continue with email</span>
                    <span class="line"></span>
                </div>
@if(session('error'))
            <div class="error-box">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-box">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
             <form method="POST"
              action="{{ route('login.store') }}">

            @csrf

                    <div class="form-group-glass">
                        <label for="email">Email address</label>
                        <div class="input-wrap">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="you@example.com"
                                value="{{ old('email') }}"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                required
                                autofocus
                            >
                        </div>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group-glass">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row-between">
                        <label class="remember-check">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        <a href="{{ url('/forgot-password') }}" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-gradient btn-auth-submit">
                        <i class="fa-solid fa-right-to-bracket"></i> Log In
                    </button>
                </form>
            </div>

        </div>
    </div>
    <script>
        setTimeout(() => {
    const errorMsg = document.querySelector('.error-box');

    if(errorMsg){

        errorMsg.style.opacity = '0';

        setTimeout(() => {
            errorMsg.remove();
        }, 500);
    }

}, 3000);
    </script>
</main>
<style>
    /* ==========================================================================
   DevConnect — Auth Pages (Login / Register)
   Shares design tokens with home.css — include home.css BEFORE this file.
   ========================================================================== */

.auth-nav{
  position: relative;
  z-index: 2;
  padding: 26px 0;
}
.auth-nav .container-xl{ display: flex; align-items: center; justify-content: space-between; }
.auth-nav .back-link{
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 0.88rem; font-weight: 500;
  color: var(--text-secondary);
  padding: 9px 16px;
  border-radius: var(--radius-pill);
  border: 1px solid var(--border-glass);
  background: var(--surface);
  transition: all 0.25s var(--ease);
}
.auth-nav .back-link:hover{ color: #fff; background: var(--surface-strong); }

.auth-wrapper{
  position: relative;
  z-index: 1;
  min-height: calc(100vh - 92px);
  display: flex;
  align-items: center;
  padding: 30px 0 70px;
}

.auth-grid{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
  max-width: 1040px;
  margin: 0 auto;
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 1px solid var(--border-glass);
  background: var(--surface);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  box-shadow: 0 30px 90px rgba(0,0,0,0.5);
}

/* ---- Left visual panel ---- */
.auth-visual-panel{
  position: relative;
  padding: 52px 44px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background: linear-gradient(160deg, rgba(139,92,246,0.28), rgba(59,130,246,0.22));
  overflow: hidden;
}
.auth-visual-panel::before{
  content: '';
  position: absolute; inset: 0;
  background: var(--grad-radial-1), var(--grad-radial-2);
  opacity: 0.8;
}
.auth-visual-panel > *{ position: relative; z-index: 1; }

.auth-visual-brand{ display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1.25rem; }

.auth-visual-quote{ margin: auto 0; padding: 40px 0; }
.auth-visual-quote i{ font-size: 1.6rem; color: rgba(255,255,255,0.5); margin-bottom: 14px; display: block; }
.auth-visual-quote p{ font-size: 1.2rem; font-weight: 500; line-height: 1.55; letter-spacing: -0.01em; }
.auth-visual-quote .quote-person{ margin-top: 18px; font-size: 0.85rem; color: var(--text-secondary); font-weight: 400; }

.auth-visual-stats{ display: flex; gap: 28px; }
.auth-visual-stats div strong{ display: block; font-size: 1.4rem; font-weight: 700; }
.auth-visual-stats div span{ font-size: 0.76rem; color: var(--text-secondary); }

/* ---- Right form panel ---- */
.auth-form-panel{
  padding: 52px 46px;
  background: rgba(10,9,18,0.4);
}
.auth-heading{ font-size: 1.7rem; font-weight: 700; letter-spacing: -0.02em; margin-bottom: 8px; }
.auth-subtext{ color: var(--text-secondary); font-size: 0.92rem; font-weight: 300; margin-bottom: 30px; }
.auth-subtext a{ color: var(--accent-blue-2); font-weight: 500; }
.auth-subtext a:hover{ text-decoration: underline; }

.social-auth-row{ display: flex; gap: 12px; margin-bottom: 26px; }
.btn-social{
  flex: 1;
  display: flex; align-items: center; justify-content: center; gap: 10px;
  padding: 11px 14px;
  border-radius: var(--radius-sm);
  border: 1px solid var(--border-glass);
  background: var(--surface);
  color: var(--text-primary);
  font-size: 0.87rem; font-weight: 500;
  transition: all 0.25s var(--ease);
}
.btn-social:hover{ background: var(--surface-strong); border-color: var(--border-glass-hi); transform: translateY(-2px); color: #fff; }
.btn-social i{ font-size: 1rem; }
.btn-social.social-github i{ color: #fff; }
.btn-social.social-google i{ color: #ea4335; }

.divider-row{ display: flex; align-items: center; gap: 14px; margin-bottom: 26px; }
.divider-row .line{ flex: 1; height: 1px; background: var(--border-glass); }
.divider-row span{ font-size: 0.76rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.08em; }

.form-group-glass{ margin-bottom: 20px; }
.form-group-glass label{
  display: block;
  font-size: 0.83rem; font-weight: 500;
  color: var(--text-secondary);
  margin-bottom: 8px;
}
.input-wrap{ position: relative; }
.input-wrap i.input-icon{
  position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
  color: var(--text-muted); font-size: 0.9rem;
}
.input-wrap input{
  width: 100%;
  background: var(--surface);
  border: 1px solid var(--border-glass);
  border-radius: var(--radius-sm);
  padding: 13px 16px 13px 42px;
  color: #fff;
  font-family: inherit;
  font-size: 0.92rem;
  transition: all 0.25s var(--ease);
}
.input-wrap input::placeholder{ color: var(--text-muted); }
.input-wrap input:focus{
  outline: none;
  border-color: var(--accent-purple-2);
  background: var(--surface-strong);
  box-shadow: 0 0 0 4px rgba(139,92,246,0.14);
}
.input-wrap input.is-invalid{ border-color: #ef4444; }
.input-wrap .toggle-password{
  position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
  background: none; border: none; color: var(--text-muted);
  cursor: pointer; font-size: 0.9rem; padding: 4px;
}
.input-wrap .toggle-password:hover{ color: var(--text-primary); }

.field-error{
  display: block;
  color: #f87171;
  font-size: 0.78rem;
  margin-top: 7px;
}

.password-strength{ display: flex; gap: 5px; margin-top: 9px; }
.password-strength span{ height: 4px; flex: 1; border-radius: 3px; background: var(--surface-strong); }

.form-row-between{
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 26px; font-size: 0.85rem;
}
.remember-check{ display: flex; align-items: center; gap: 8px; color: var(--text-secondary); cursor: pointer; }
.remember-check input{ accent-color: var(--accent-purple); width: 16px; height: 16px; }
.forgot-link{ color: var(--accent-blue-2); font-weight: 500; }
.forgot-link:hover{ text-decoration: underline; }

.terms-check{ display: flex; align-items: flex-start; gap: 10px; margin-bottom: 26px; font-size: 0.83rem; color: var(--text-secondary); line-height: 1.5; }
.terms-check input{ accent-color: var(--accent-purple); width: 16px; height: 16px; margin-top: 2px; flex-shrink: 0; }
.terms-check a{ color: var(--accent-blue-2); font-weight: 500; }
.terms-check a:hover{ text-decoration: underline; }

.btn-auth-submit{ width: 100%; padding: 13px; font-size: 0.95rem; }

.auth-alert{
  display: flex; align-items: center; gap: 10px;
  background: rgba(239,68,68,0.1);
  border: 1px solid rgba(239,68,68,0.35);
  color: #fca5a5;
  padding: 12px 16px;
  border-radius: var(--radius-sm);
  font-size: 0.85rem;
  margin-bottom: 22px;
}
.auth-alert.success{
  background: rgba(34,197,94,0.1);
  border-color: rgba(34,197,94,0.35);
  color: #86efac;
}
.error-box{

    padding:15px;

    border-radius:14px;

    margin-bottom:15px;

    color:#ffb3b3;

    background:
    rgba(255,0,0,.15);

    border:
    1px solid rgba(255,0,0,.25);
}
@media (max-width: 900px){
  .auth-grid{ grid-template-columns: 1fr; max-width: 480px; }
  .auth-visual-panel{ display: none; }
  .auth-form-panel{ padding: 40px 28px; }
}
</style>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush