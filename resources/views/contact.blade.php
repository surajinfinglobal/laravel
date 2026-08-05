{{-- =========================================================================
     DevConnect — Contact Us
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'Contact Us — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    
    .contact-header {
        text-align: center;
        margin-bottom: 48px;
    }
    .contact-header .eyebrow {
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
    .contact-header h1 {
        font-size: clamp(2rem, 5vw, 2.8rem);
        font-weight: 700;
        margin-bottom: 12px;
    }
    .contact-header p {
        color: #94a3b8;
        max-width: 520px;
        margin: 0 auto;
        font-size: 0.95rem;
    }

    .contact-container {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 24px;
        max-width: 1000px;
        margin: 0 auto;
    }
    @media (max-width: 768px) {
        .contact-container { grid-template-columns: 1fr; }
    }

    .contact-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 18px;
        padding: 28px;
        backdrop-filter: blur(12px);
        height: 100%;
    }

    .info-box {
        margin-bottom: 22px;
    }
    .info-box h3 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #c4b5fd;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-box p {
        color: #cbd5e1;
        font-size: 0.95rem;
        margin: 0;
    }

    .socials {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .socials a {
        text-decoration: none;
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 8px 14px;
        border-radius: 50px;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.04);
        transition: all 0.2s;
    }
    .socials a:hover {
        color: #c4b5fd;
        border-color: rgba(139, 92, 246, 0.4);
    }

    .contact-form .form-group {
        margin-bottom: 16px;
    }
    .contact-form label {
        display: block;
        font-size: 0.85rem;
        color: #94a3b8;
        margin-bottom: 6px;
        font-weight: 500;
    }
    .contact-form input,
    .contact-form textarea {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 12px;
        padding: 12px 16px;
        color: #e2e8f0;
        font-size: 0.95rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }
    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: rgba(139, 92, 246, 0.6);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
    }
    .contact-form input::placeholder,
    .contact-form textarea::placeholder {
        color: #64748b;
    }
    .contact-form textarea {
        min-height: 140px;
        resize: vertical;
    }
    .contact-form .btn-submit {
        width: 100%;
        margin-top: 8px;
        padding: 14px;
        font-size: 1rem;
        font-weight: 600;
    }
    .form-error {
        color: #f87171;
        font-size: 0.8rem;
        margin-top: 4px;
    }
    .success-box {
        background: rgba(34, 197, 94, 0.12);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #4ade80;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 18px;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main>
<section class="contact-section">
    <div class="container-xl">

        <div class="contact-header">
            <span class="eyebrow">
                <i class="fa-solid fa-envelope"></i> Get in Touch
            </span>
            <h1>Contact <span class="text-gradient">Us</span></h1>
            <p>
                Have a question, suggestion, or project idea?
                We'd love to hear from you.
            </p>
        </div>

        <div class="contact-container">

            {{-- Left: Info --}}
            <div class="contact-card">
                <div class="info-box">
                    <h3><i class="fa-solid fa-location-dot"></i> Address</h3>
                    <p>Ahmedabad, Gujarat, India</p>
                </div>
                <div class="info-box">
                    <h3><i class="fa-solid fa-envelope"></i> Email</h3>
                    <p>hello@devconnect.app</p>
                </div>
                <div class="info-box">
                    <h3><i class="fa-solid fa-phone"></i> Phone</h3>
                    <p>+91 98765 43210</p>
                </div>
                <div class="info-box">
                    <h3><i class="fa-solid fa-clock"></i> Working Hours</h3>
                    <p>Mon - Sat : 9:00 AM - 7:00 PM</p>
                </div>

                <div class="socials">
                    <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</a>
                    <a href="#"><i class="fa-brands fa-github"></i> GitHub</a>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="contact-card">
                @if(session('success'))
                <div class="success-box">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
                @endif

                <form class="contact-form" method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               placeholder="Your Name" required>
                        @error('name')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="Email Address" required>
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject"
                               value="{{ old('subject') }}"
                               placeholder="Subject" required>
                        @error('subject')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message"
                                  placeholder="Write your message..." required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient btn-submit">
                        <i class="fa-solid fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
</main>

@endsection