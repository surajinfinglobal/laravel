@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="glass-card text-center p-5">

                <div class="mb-4">
                    <i class="fa-solid fa-circle-check"
                       style="font-size:70px;color:#22c55e;"></i>
                </div>

                <h1 class="text-white mb-3">
                    Payment Successful!
                </h1>

                <p class="text-secondary mb-4">
                    Your payment has been successfully completed.
                </p>

                @if(isset($sessionId))
                    <small class="text-secondary">
                        Stripe Session:
                        {{ $sessionId }}
                    </small>
                @endif

                <div class="mt-4">

                    <a href="{{ url('/home/project') }}"
                       class="btn btn-gradient">
                        Explore Projects
                    </a>

                    <a href="{{ url('/home') }}"
                       class="btn btn-outline-light ms-2">
                        Dashboard
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection