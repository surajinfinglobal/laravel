<!-- <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --bg:#06080d;
    --glass:rgba(255,255,255,.08);
    --border:rgba(255,255,255,.14);
    --text:#fff;
    --muted:#9aa4b2;
}

body{
    min-height:100vh;
    font-family:'Inter',sans-serif;
    color:white;

    background:
    radial-gradient(circle at top left,
    rgba(255,255,255,.04),
    transparent 30%),

    radial-gradient(circle at bottom right,
    rgba(0,150,255,.08),
    transparent 40%),

    #06080d;
}

/* Navbar */

.nav{
    position:fixed;
    top:32px;
    left:50%;
    transform:translateX(-50%);
    width:min(1200px,92vw);
    height:78px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 18px;
    border-radius:30px;

    background:rgba(255,255,255,.06);
    backdrop-filter:blur(30px);

    border:1px solid rgba(255,255,255,.12);

    box-shadow:
    inset 0 1px 0 rgba(255,255,255,.2),
    0 20px 50px rgba(0,0,0,.35);

    z-index:1000;
}

.logo{
    font-weight:700;
    letter-spacing:4px;
}

.cta{
    height:50px;
    padding:0 22px;
    border:none;
    border-radius:14px;
    color:white;
    cursor:pointer;

    background:rgba(255,255,255,.08);

    border:1px solid rgba(255,255,255,.15);

    backdrop-filter:blur(20px);

    transition:.3s;
}

.cta:hover{
    transform:translateY(-3px);
}

/* Hero */

.hero{
    width:100%;
    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding:20px;
}

.hero-content{
    max-width:900px;
}

.hero h1{
    font-size:clamp(50px,8vw,110px);
    line-height:1;
    font-weight:800;

    background:linear-gradient(
    90deg,
    #fff,
    #86c5ff,
    #ffffff);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;

    margin-bottom:20px;
}

.hero p{
    font-size:20px;
    color:var(--muted);
    line-height:1.8;
    margin-bottom:40px;
}

.hero-buttons{
    display:flex;
    justify-content:center;
    gap:20px;
    flex-wrap:wrap;
}

.btn{
    padding:18px 34px;
    border-radius:16px;
    border:none;
    cursor:pointer;

    font-size:16px;
    font-weight:600;

    transition:.3s;
}

.btn-primary{
    color:#000;
    background:#fff;
}

.btn-secondary{
    color:white;

    background:rgba(255,255,255,.08);

    border:1px solid rgba(255,255,255,.15);

    backdrop-filter:blur(20px);
}

.btn:hover{
    transform:translateY(-4px);
}

/* Floating Glass Cards */

.glass-card{
    position:absolute;

    width:180px;
    height:180px;

    border-radius:30px;

    background:rgba(255,255,255,.05);

    backdrop-filter:blur(25px);

    border:1px solid rgba(255,255,255,.08);
}

.card1{
    top:18%;
    left:10%;
}

.card2{
    bottom:15%;
    right:10%;
}
</style>
@extends('navbar')

<section class="hero">

    <div class="hero-content">

        <h1>Welcome To Main Page</h1>

        <p>
            Build modern web experiences with premium
            liquid glass interfaces, smooth animations,
            and next-generation design systems.
        </p>

        <div class="hero-buttons">

            <button class="btn btn-primary">
                Get Started
            </button>

            <button class="btn btn-secondary">
                Learn More
            </button>

        </div>

    </div>

</section> -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="landing-page">

    <!-- Hero Section -->

    <section class="hero">

        <div class="hero-content">

            @auth
                <span class="welcome-user">
                    👋 Welcome Back, {{ auth()->user()->name }}
                </span>
            @endauth

            <h1>
                Build The Future
                With Modern Design
            </h1>
@guest

<h1>bhai pehle log in karo </h1>
@endguest
            <p>
                Create stunning experiences with modern
                UI, smooth animations, glassmorphism,
                and powerful web applications.
            </p>

            <div class="hero-buttons">
                <button class="primary-btn">
                    Get Started
                </button>

                <button class="secondary-btn">
                    Learn More
                </button>
            </div>

        </div>

        <div class="hero-image">

            <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200"
                 alt="Technology">

        </div>

    </section>

    <!-- Features -->

    <section class="features">

        <div class="card">
            <h3>⚡ Fast Performance</h3>
            <p>
                Optimized user experience with modern
                technologies.
            </p>
        </div>

        <div class="card">
            <h3>🎨 Modern Design</h3>
            <p>
                Premium glassmorphism UI and smooth
                interactions.
            </p>
        </div>

        <div class="card">
            <h3>🔒 Secure System</h3>
            <p>
                Authentication, validation and secure
                architecture.
            </p>
        </div>

    </section>
     <section class="stats">

    <div class="stat-box">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
             alt="Users">

        <h2>10K+</h2>
        <p>Users</p>

    </div>

    <div class="stat-box">

        <img src="https://cdn-icons-png.flaticon.com/512/1048/1048941.png"
             alt="Projects">

        <h2>500+</h2>
        <p>Projects</p>

    </div>

    <div class="stat-box">

        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png"
             alt="Satisfaction">

        <h2>99%</h2>
        <p>Satisfaction</p>

    </div>

</section>
    <section class="features">

        <div class="card">
            <h3>⚡ Fast Performance</h3>
            <p>
                Optimized user experience with modern
                technologies.
            </p>
        </div>

        <div class="card">
            <h3>🎨 Modern Design</h3>
            <p>
                Premium glassmorphism UI and smooth
                interactions.
            </p>
        </div>

        <div class="card">
            <h3>🔒 Secure System</h3>
            <p>
                Authentication, validation and secure
                architecture.
            </p>
        </div>

    </section>
   <section class="stats">

    <div class="stat-box">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
             alt="Users">

        <h2>10K+</h2>
        <p>Users</p>

    </div>

    <div class="stat-box">

        <img src="https://cdn-icons-png.flaticon.com/512/1048/1048941.png"
             alt="Projects">

        <h2>500+</h2>
        <p>Projects</p>

    </div>

    <div class="stat-box">

        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png"
             alt="Satisfaction">

        <h2>99%</h2>
        <p>Satisfaction</p>

    </div>

</section>

    <!-- Stats -->

    <section class="stats">

        <div class="stat-box">
            <h2>10K+</h2>
            <p>Users</p>
        </div>

        <div class="stat-box">
            <h2>500+</h2>
            <p>Projects</p>
        </div>

        <div class="stat-box">
            <h2>99%</h2>
            <p>Satisfaction</p>
        </div>

    </section>

</div>

<style>
.stat-box{

    text-align:center;

    padding:35px;

    border-radius:25px;

    background:
    rgba(255,255,255,.05);

    backdrop-filter:blur(25px);

    border:
    1px solid rgba(255,255,255,.08);

    transition:.4s;
}

.stat-box:hover{

    transform:
    translateY(-8px);

    background:
    rgba(255,255,255,.08);
}

.stat-box img{

    width:80px;
    height:80px;

    object-fit:contain;

    margin-bottom:20px;

    filter:
    drop-shadow(0 10px 20px rgba(255,255,255,.15));
}

.stat-box h2{

    color:white;

    font-size:50px;

    margin-bottom:10px;
}

.stat-box p{

    color:#9aa4b2;

    font-size:18px;
}
.landing-page{
    width:min(1300px,95%);
    margin:140px auto 50px;
}

/* Hero */

.hero{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:50px;
    align-items:center;
}

.hero-content h1{
    font-size:70px;
    color:#fff;
    line-height:1.1;
    margin:20px 0;
}

.hero-content p{
    color:#9aa4b2;
    font-size:18px;
    line-height:1.8;
    max-width:600px;
}

.welcome-user{
    display:inline-block;
    padding:12px 20px;
    border-radius:30px;
    color:#fff;

    background:
    rgba(255,255,255,.08);

    border:
    1px solid rgba(255,255,255,.12);
}

.hero-buttons{
    margin-top:30px;
    display:flex;
    gap:15px;
}

.primary-btn,
.secondary-btn{

    height:55px;
    padding:0 30px;

    border:none;

    border-radius:16px;

    cursor:pointer;

    font-weight:600;
}

.primary-btn{
    background:white;
}

.secondary-btn{

    color:white;

    background:
    rgba(255,255,255,.08);

    border:
    1px solid rgba(255,255,255,.12);
}

.hero-image img{
    width:100%;
    border-radius:30px;
    object-fit:cover;

    border:
    1px solid rgba(255,255,255,.08);

    box-shadow:
    0 20px 50px rgba(0,0,0,.3);
}

/* Features */

.features{

    margin-top:80px;

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:25px;
}

.card{

    padding:30px;

    border-radius:25px;

    background:
    rgba(255,255,255,.05);

    backdrop-filter:
    blur(25px);

    border:
    1px solid rgba(255,255,255,.08);
}

.card h3{
    color:white;
    margin-bottom:15px;
}

.card p{
    color:#9aa4b2;
}

/* Stats */

.stats{

    margin-top:80px;

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:25px;
}

.stat-box{

    text-align:center;

    padding:35px;

    border-radius:25px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);
}

.stat-box h2{
    color:white;
    font-size:50px;
}

.stat-box p{
    color:#9aa4b2;
}

@media(max-width:900px){

    .hero{
        grid-template-columns:1fr;
    }

    .hero-content h1{
        font-size:45px;
    }

    .features,
    .stats{
        grid-template-columns:1fr;
    }

}

</style>
