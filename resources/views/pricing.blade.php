{{-- =========================================================================
     DevConnect — Pricing Page
     Dark theme · Glassmorphism · Purple + Blue gradients · Poppins · Bootstrap 5
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'Pricing — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    /* ========== Page Hero ========== */
    .page-hero {
        padding: 110px 0 40px;
        text-align: center;
    }

    .page-hero .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        color: #c4b5fd;
        margin-bottom: 16px;
    }

    .page-hero h1 {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700;
        margin-bottom: 12px;
    }

    .page-hero p {
        color: #94a3b8;
        max-width: 560px;
        margin: 0 auto 0;
    }

    /* ========== Billing Toggle ========== */
    .billing-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        margin: 36px 0 30px;
    }

    .billing-toggle span {
        font-size: 0.95rem;
        color: #94a3b8;
        font-weight: 500;
    }

    .billing-toggle span.active {
        color: #e2e8f0;
    }

    .toggle-switch {
        position: relative;
        width: 56px;
        height: 30px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50px;
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: background 0.25s;
    }

    .toggle-switch.active {
        background: linear-gradient(135deg, #7c3aed, #2563eb);
    }

    .toggle-switch .knob {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 22px;
        height: 22px;
        background: #fff;
        border-radius: 50%;
        transition: transform 0.25s;
    }

    .toggle-switch.active .knob {
        transform: translateX(26px);
    }

    .save-badge {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 50px;
    }

    /* ========== Pricing Cards ========== */
    .pricing-card {
        position: relative;
        padding: 32px 28px;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s, border-color 0.3s;
    }

    .pricing-card:hover {
        transform: translateY(-6px);
    }

    .pricing-card.featured {
        border: 1px solid rgba(139, 92, 246, 0.5);
        background: linear-gradient(160deg, rgba(124, 58, 237, 0.12), rgba(37, 99, 235, 0.08));
    }

    .pricing-card.featured::before {
        content: 'Most Popular';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 16px;
        border-radius: 50px;
        white-space: nowrap;
    }

    .plan-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #c4b5fd;
        margin-bottom: 8px;
    }

    .plan-price {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 6px;
    }

    .plan-price .currency {
        font-size: 1.3rem;
        font-weight: 600;
        color: #94a3b8;
    }

    .plan-price .amount {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1;
        background: linear-gradient(135deg, #a78bfa, #60a5fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .plan-price .period {
        font-size: 0.95rem;
        color: #94a3b8;
    }

    .plan-desc {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 24px;
    }

    .plan-features {
        list-style: none;
        padding: 0;
        margin: 0 0 28px;
        flex: 1;
    }

    .plan-features li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 8px 0;
        font-size: 0.9rem;
        color: #cbd5e1;
    }

    .plan-features li i {
        color: #4ade80;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .plan-features li.disabled {
        color: #64748b;
    }

    .plan-features li.disabled i {
        color: #475569;
    }

    .pricing-card .btn {
        width: 100%;
        justify-content: center;
    }

    /* ========== FAQ ========== */
    .faq-section {
        padding: 80px 0 100px;
    }

    .faq-item {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 14px;
        margin-bottom: 12px;
        overflow: hidden;
    }

    .faq-question {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 22px;
        background: transparent;
        border: none;
        color: #e2e8f0;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        text-align: left;
    }

    .faq-question i {
        transition: transform 0.25s;
        color: #94a3b8;
    }

    .faq-item.open .faq-question i {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .faq-answer-inner {
        padding: 0 22px 18px;
        color: #94a3b8;
        font-size: 0.925rem;
        line-height: 1.6;
    }

    .faq-item.open .faq-answer {
        max-height: 200px;
    }

    /* ========== CTA ========== */
    .pricing-cta {
        text-align: center;
        padding: 60px 0 100px;
    }

    .pricing-cta h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .pricing-cta p {
        color: #94a3b8;
        margin-bottom: 28px;
    }

    .current-plan-badge {
        position: absolute;
        top: -12px;
        right: 16px;
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.35);
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .pricing-card button:disabled,
    .pricing-card a[disabled] {
        opacity: 0.7;
        cursor: default;
        pointer-events: none;
    }
</style>
@endpush

@section('content')

{{-- Ambient orbs --}}
<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main>

    {{-- =====================================================
         Hero
         ===================================================== --}}

    {{-- =====================================================
         Billing Toggle
         ===================================================== --}}
    <div class="container-xl">
        <div class="billing-toggle">
            <span class="active" id="labelMonthly">Monthly</span>
            <div class="toggle-switch" id="billingToggle" onclick="toggleBilling()">
                <div class="knob"></div>
            </div>
            <span id="labelYearly">Yearly</span>
            <span class="save-badge">Save 20%</span>
        </div>
    </div>

    {{-- =====================================================
         Pricing Cards
         ===================================================== --}}
    <section style="padding-bottom: 40px;">
        <div class="container-xl">
            <div class="row g-4 justify-content-center">

                {{-- Free Plan --}}
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card pricing-card">
                        <div class="plan-name">Free</div>
                        <div class="plan-price">
                            <span class="currency">$</span>
                            <span class="amount" id="FreeAmount" data-monthly="0" data-yearly="0">0</span>
                            <span class="period" id="FreePeriod">/mo</span>
                        </div>
                        <p class="plan-desc">Perfect for getting started and showcasing a few projects.</p>
                        <ul class="plan-features">
                            <li><i class="fa-solid fa-check"></i> Up to 3 projects</li>
                            <li><i class="fa-solid fa-check"></i> Basic profile</li>
                            <li><i class="fa-solid fa-check"></i> Community access</li>
                            <li><i class="fa-solid fa-check"></i> Like & rate projects</li>
                            <li class="disabled"><i class="fa-solid fa-xmark"></i> Analytics dashboard</li>
                            <li class="disabled"><i class="fa-solid fa-xmark"></i> Priority listing</li>
                            <li class="disabled"><i class="fa-solid fa-xmark"></i> Custom domain</li>
                        </ul>

                        @if(($membershipStatus ?? 'free') === 'free')
                        <div class="current-plan-badge">Current Plan</div>
                        <button class="btn btn-ghost" disabled>Your Current Plan</button>
                        @else
                        <a href="{{ url('home/payment?plan=Free&billing=monthly&amount=0') }}"
                            class="btn btn-ghost" id="btnfree" data-plan="free">
                            Get Started
                        </a>
                        @endif

                    </div>
                </div>

                {{-- Pro Plan (Featured) --}}
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card pricing-card featured">
                        <div class="plan-name">Pro</div>
                        <div class="plan-price">
                            <span class="currency">$</span>
                             @if(($membershipStatus ?? '') === 'pro')
                             <span class="amount" id="proAmount" data-monthly="{{$amount}}" data-yearly="20">
                                {{$amount}}
                            </span>
                            @else
                            <span class="amount" id="proAmount" data-monthly="12" data-yearly="20">
                                12
                            </span>
                            @endif
                            <span class="period" id="proPeriod">/mo</span>
                        </div>
                        <p class="plan-desc">For serious builders who want more reach and insights.</p>
                        <ul class="plan-features">
                            <li><i class="fa-solid fa-check"></i> Unlimited projects</li>
                            <li><i class="fa-solid fa-check"></i> Advanced profile</li>
                            <li><i class="fa-solid fa-check"></i> Analytics dashboard</li>
                            <li><i class="fa-solid fa-check"></i> Priority in search</li>
                            <li><i class="fa-solid fa-check"></i> Custom project URLs</li>
                            <li><i class="fa-solid fa-check"></i> Remove DevConnect branding</li>
                            <li class="disabled"><i class="fa-solid fa-xmark"></i> Team collaboration</li>
                        </ul>
                        @if(($membershipStatus ?? '') === 'pro')
                        <div class="current-plan-badge">Current Plan</div>
                        <button class="btn btn-gradient" disabled>Your Current Plan</button>
                        @else
                        <a href="{{ url('home/payment?plan=pro&billing=monthly') }}"
                            class="btn btn-gradient upgrade-btn"
                            data-plan="pro"
                            id="btnPro">
                            Upgrade to Pro
                        </a>
                        @endif

                    </div>
                </div>

                {{-- Team Plan --}}
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card pricing-card">
                        <div class="plan-name">Team</div>
                        <div class="plan-price">
                            <span class="currency">$</span>
                             @if(($membershipStatus ?? '') === 'team')
                            <span id="teamAmount" class="amount" data-monthly="{{$amount}}" data-yearly="45"></span>
                            @else
                             <span id="teamAmount" class="amount" data-monthly="29" data-yearly="45">29</span>
                              @endif
                            <span class="period" id="teammonth">/mo</span>
                        </div>
                        <p class="plan-desc">Built for studios and teams shipping together.</p>
                        <ul class="plan-features">
                            <li><i class="fa-solid fa-check"></i> Everything in Pro</li>
                            <li><i class="fa-solid fa-check"></i> Up to 10 team members</li>
                            <li><i class="fa-solid fa-check"></i> Shared workspace</li>
                            <li><i class="fa-solid fa-check"></i> Team analytics</li>
                            <li><i class="fa-solid fa-check"></i> Role-based access</li>
                            <li><i class="fa-solid fa-check"></i> Priority support</li>
                            <li><i class="fa-solid fa-check"></i> Custom domain</li>
                        </ul>
                        @if(($membershipStatus ?? '') === 'team')
                        <div class="current-plan-badge">Current Plan</div>
                        <button class="btn btn-ghost" disabled>Your Current Plan</button>
                        @else
                        <a href="{{ url('home/payment?plan=team&billing=monthly') }}"
                            class="btn btn-ghost upgrade-btn"
                            data-plan="team"
                            id="btnTeam">
                            Get Team Plan
                        </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =====================================================
         FAQ
         ===================================================== --}}
    <section class="faq-section">
        <div class="container-xl">
            <div class="section-head-wrap text-center" style="margin-bottom: 40px;">
                <span class="eyebrow"><i class="fa-solid fa-circle-question"></i> FAQ</span>
                <h2 class="section-heading">Frequently Asked <span class="text-gradient">Questions</span></h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Can I switch plans anytime?
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Yes. You can upgrade or downgrade your plan at any time. Changes take effect immediately and billing is prorated.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Is there a free trial for Pro?
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                The Free plan is available forever. Pro and Team plans come with a 14-day free trial — no credit card required.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            What payment methods do you accept?
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                We accept all major credit cards (Visa, Mastercard, Amex) and PayPal. Invoicing is available for Team plans.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Can I cancel anytime?
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Absolutely. Cancel from your account settings with one click. You’ll keep access until the end of your billing period.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================
         Bottom CTA
         ===================================================== --}}
    <section class="pricing-cta">
        <div class="container-xl">
            <h2>Still have questions?</h2>
            <p>Our team is happy to help you pick the right plan.</p>
            <a href="{{ url('/contact') }}" class="btn btn-gradient">
                <i class="fa-solid fa-envelope"></i> Contact Us
            </a>
        </div>
    </section>

</main>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        updatePlanLinks(false);

        const btnfree = "{{ url('home/payment') }}";
        $('#btnfree').attr('href', `${btnfree}?plan=Free&billing=monthly&amount=${$('#FreeAmount').data('monthly')}`);
    });


    function updatePlanLinks(isYearly) {
        const stripeCheckoutUrl = "{{ route('stripe.checkout') }}";
        const billing = isYearly ? 'yearly' : 'monthly';


        if (isYearly) {

            $('#proAmount').text($('#proAmount').data('yearly'));
            $('#teamAmount').text($('#teamAmount').data('yearly'));

            $('#proPeriod').text('/yr');
            $('#teammonth').text('/yr');

            $('#btnPro').attr('href',`${stripeCheckoutUrl}?plan=pro&billing=yearly`);
            $('#btnTeam').attr('href',`${stripeCheckoutUrl}?plan=team&billing=yearly`);

        } else {


            $('#proAmount').text($('#proAmount').data('monthly'));
            $('#teamAmount').text($('#teamAmount').data('monthly'));

            $('#proPeriod').text('/mo');
            $('#teammonth').text('/mo');

            $('#btnPro').attr('href',`${stripeCheckoutUrl}?plan=pro&billing=monthly`);
            $('#btnTeam').attr('href',`${stripeCheckoutUrl}?plan=team&billing=monthly`);
        }
    }

    function toggleBilling() {
        const $toggle = $('#billingToggle');
        const $labelMonthly = $('#labelMonthly');
        const $labelYearly = $('#labelYearly');
        const stripeCheckoutUrl = "{{ route('stripe.checkout') }}";

        $toggle.toggleClass('active');

        const isYearly = $toggle.hasClass('active');
        $('#btnPro').attr(
            'href',
            `${stripeCheckoutUrl}?plan=pro&billing=${isYearly ? 'yearly' : 'monthly'}`
        );

        $('#btnTeam').attr(
            'href',
            `${stripeCheckoutUrl}?plan=team&billing=${isYearly ? 'yearly' : 'monthly'}`
        );

        if ($toggle.hasClass('active')) {

            $labelMonthly.removeClass('active');
            $labelYearly.addClass('active');

        } else {

            $labelYearly.removeClass('active');
            $labelMonthly.addClass('active');

        }

        // URL + amount update
        updatePlanLinks(isYearly);
    }

    // FAQ accordion
    function toggleFaq(btn) {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');

        // Close all
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));

        // Open clicked if it was closed
        if (!isOpen) {
            item.classList.add('open');
        }
    }
</script>
@endpush