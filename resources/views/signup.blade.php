{{-- =========================================================================
     DevConnect — Register Page
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'Create Account — DevConnect')

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
                    <p>"Uploading projects is effortless and the community feedback pushed me to improve my code quality."</p>
                    <div class="quote-person">Aisha Bello — Backend Developer</div>
                </div>

                <div class="auth-visual-stats">
                    <div><strong>12.4k+</strong><span>Developers</span></div>
                    <div><strong>54k+</strong><span>Likes Given</span></div>
                    <div><strong>4.9</strong><span>Avg Rating</span></div>
                </div>
            </div>

            {{-- Right form panel --}}
            <div class="auth-form-panel">
                <h1 class="auth-heading">Create your account</h1>
                <p class="auth-subtext">Start sharing your projects today. Already have an account? <a href="{{route('login') }}">Log in</a></p>

                @if ($errors->any())
                    <div class="auth-alert">
                        <i class="fa-solid fa-circle-exclamation"></i> Please fix the errors below and try again.
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
                    <span>or sign up with email</span>
                    <span class="line"></span>
                </div>

                <form method="POST" action="{{ route('signup.store') }}" novalidate>
                    @csrf

                    <div class="form-group-glass">
                        <label for="name">Full name</label>
                        <div class="input-wrap">
                            <i class="fa-regular fa-user input-icon"></i>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Jane Doe"
                                value="{{ old('name') }}"
                                class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                required
                                autofocus
                            >
                        </div>
                        @error('name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

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
                                placeholder="Create a password"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength" aria-hidden="true">
                            <span></span><span></span><span></span><span></span>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    

                    <label class="terms-check">
                        <input type="checkbox" name="terms" required>
                        <span>I agree to DevConnect's <a href="{{ url('/terms') }}">Terms of Service</a> and <a href="{{ url('/privacy') }}">Privacy Policy</a></span>
                    </label>

                    <button type="submit" class="btn btn-gradient btn-auth-submit">
                        <i class="fa-solid fa-user-plus"></i> Create Account
                    </button>
                </form>
            </div>

        </div>
    </div>
</main>

@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush