{{-- =========================================================================
     DevConnect — About Page
     ========================================================================= --}}
@extends('layouts.app')

@section('title', 'About Us — DevConnect')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>

    .about-hero {
        text-align: center;
        margin-bottom: 60px;
    }
    .about-hero .eyebrow {
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
    .about-hero h1 {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700;
        margin-bottom: 16px;
    }
    .about-hero p {
        color: #94a3b8;
        max-width: 640px;
        margin: 0 auto;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    .about-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 18px;
        padding: 28px;
        backdrop-filter: blur(12px);
        height: 100%;
        transition: transform 0.25s, border-color 0.25s;
    }
    .about-card:hover {
        transform: translateY(-4px);
        border-color: rgba(139, 92, 246, 0.35);
    }
    .about-card .icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(124,58,237,0.25), rgba(37,99,235,0.2));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a78bfa;
        font-size: 1.2rem;
        margin-bottom: 16px;
    }
    .about-card h3 {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #e2e8f0;
    }
    .about-card p {
        color: #94a3b8;
        font-size: 0.925rem;
        line-height: 1.65;
        margin: 0;
    }

    .story-section {
        margin: 70px 0;
    }
    .story-section h2 {
        font-size: clamp(1.6rem, 3vw, 2rem);
        font-weight: 700;
        margin-bottom: 16px;
    }
    .story-section p {
        color: #94a3b8;
        font-size: 0.975rem;
        line-height: 1.75;
        margin-bottom: 14px;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin: 50px 0 70px;
    }
    @media (max-width: 768px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }
    .stat-box {
        text-align: center;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 24px 12px;
    }
    .stat-box .num {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #a78bfa, #60a5fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .stat-box .lbl {
        font-size: 0.85rem;
        color: #94a3b8;
        margin-top: 6px;
    }

    .team-card {
        text-align: center;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 18px;
        padding: 28px 20px;
        height: 100%;
    }
    .team-card img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 14px;
        border: 2px solid rgba(139, 92, 246, 0.4);
    }
    .team-card h4 {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 4px;
        color: #e2e8f0;
    }
    .team-card .role {
        font-size: 0.85rem;
        color: #a78bfa;
        margin-bottom: 10px;
    }
    .team-card p {
        font-size: 0.85rem;
        color: #94a3b8;
        margin: 0;
    }

    .about-cta {
        text-align: center;
        margin-top: 70px;
        padding: 48px 28px;
        background: linear-gradient(160deg, rgba(124,58,237,0.12), rgba(37,99,235,0.08));
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
    }
    .about-cta h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .about-cta p {
        color: #94a3b8;
        margin-bottom: 24px;
    }
</style>
@endpush

@section('content')

<div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<main class="about-page">
    <div class="container-xl">

        {{-- Hero --}}
        <div class="about-hero">
            <span class="eyebrow">
                <i class="fa-solid fa-code"></i> Our Story
            </span>
            <h1>About <span class="text-gradient">DevConnect</span></h1>
            <p>
                DevConnect is the home for developers to showcase projects,
                get discovered, and grow with a global community of builders.
            </p>
        </div>

        {{-- Mission / Vision / Values --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="about-card">
                    <div class="icon"><i class="fa-solid fa-bullseye"></i></div>
                    <h3>Our Mission</h3>
                    <p>
                        Make it simple for every developer to ship in public,
                        build a credible portfolio, and connect with opportunities.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card">
                    <div class="icon"><i class="fa-solid fa-eye"></i></div>
                    <h3>Our Vision</h3>
                    <p>
                        A world where talent is visible by the work itself —
                        not just by degrees or job titles.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card">
                    <div class="icon"><i class="fa-solid fa-heart"></i></div>
                    <h3>Our Values</h3>
                    <p>
                        Openness, craftsmanship, and community.
                        We build tools that respect creators and their time.
                    </p>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-box">
                <div class="num">12k+</div>
                <div class="lbl">Developers</div>
            </div>
            <div class="stat-box">
                <div class="num">8.5k+</div>
                <div class="lbl">Projects</div>
            </div>
            <div class="stat-box">
                <div class="num">54k+</div>
                <div class="lbl">Likes</div>
            </div>
            <div class="stat-box">
                <div class="num">30+</div>
                <div class="lbl">Countries</div>
            </div>
        </div>

        {{-- Story --}}
        <div class="story-section row align-items-center g-4">
            <div class="col-lg-6">
                <h2>Built by developers, <span class="text-gradient">for developers</span></h2>
                <p>
                    DevConnect started from a simple problem: great side projects
                    often stay hidden on local machines or buried in GitHub repos.
                </p>
                <p>
                    We built a place where you can upload projects, share your stack,
                    collect feedback through likes and ratings, and turn your work
                    into a living portfolio that recruiters and collaborators can trust.
                </p>
                <p>
                    Today, thousands of builders use DevConnect to ship in public
                    and grow their network — one project at a time.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="about-card">
                    <div class="icon"><i class="fa-solid fa-rocket"></i></div>
                    <h3>What you can do</h3>
                    <p style="margin-bottom:12px;">
                        • Upload projects with images, tech stack & links<br>
                        • Get likes, ratings and real community feedback<br>
                        • Discover work by category and technology<br>
                        • Build a public profile that stands out<br>
                        • Connect with developers worldwide
                    </p>
                </div>
            </div>
        </div>

        {{-- Team (optional static) --}}
        <div class="text-center mb-4">
            <span class="eyebrow" style="display:inline-flex;align-items:center;gap:8px;background:rgba(139,92,246,0.15);border:1px solid rgba(139,92,246,0.3);padding:6px 16px;border-radius:50px;font-size:0.85rem;color:#c4b5fd;margin-bottom:14px;">
                <i class="fa-solid fa-users"></i> The Team
            </span>
            <h2 style="font-size:1.8rem;font-weight:700;margin-bottom:8px;">
                People behind <span class="text-gradient">DevConnect</span>
            </h2>
            <p style="color:#94a3b8;margin-bottom:32px;">A small team obsessed with developer experience.</p>
        </div>

        <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
                <div class="team-card">
                    <img src="https://i.pravatar.cc/180?img=11" alt="Team member">
                    <h4>Ethan Wright</h4>
                    <div class="role">Founder & CEO</div>
                    <p>Full-stack engineer turned product builder.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="team-card">
                    <img src="https://i.pravatar.cc/180?img=5" alt="Team member">
                    <h4>Sofia Rossi</h4>
                    <div class="role">Head of Product</div>
                    <p>Designs flows that developers actually enjoy.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="team-card">
                    <img src="https://i.pravatar.cc/180?img=14" alt="Team member">
                    <h4>Kunal Verma</h4>
                    <div class="role">Engineering Lead</div>
                    <p>Scales the platform and keeps it fast.</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="team-card">
                    <img src="https://i.pravatar.cc/180?img=9" alt="Team member">
                    <h4>Grace Kim</h4>
                    <div class="role">Community</div>
                    <p>Connects builders and grows the network.</p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="about-cta">
            <h2>Ready to showcase your work?</h2>
            <p>Join developers already building in public on DevConnect.</p>
            <a href="{{ url('/register') }}" class="btn btn-gradient">
                <i class="fa-solid fa-rocket"></i> Get Started
            </a>
            <a href="{{ url('/home/project') }}" class="btn btn-outline-light" style="margin-left:10px;">
                <i class="fa-solid fa-compass"></i> Explore Projects
            </a>
        </div>

    </div>
</main>

@endsection