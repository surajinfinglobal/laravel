<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pricing | NOVA</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

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

    transition:.3s;
}

.cta:hover{
    transform:translateY(-3px);
}

/* Hero */

.hero{
    padding-top:160px;
    text-align:center;
}

.hero h1{
    font-size:clamp(50px,8vw,100px);
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
    color:var(--muted);
    font-size:18px;
    max-width:700px;
    margin:auto;
}

/* Pricing */

.pricing{
    width:min(1200px,92vw);
    margin:80px auto;

    display:grid;
    grid-template-columns:
    repeat(auto-fit,minmax(280px,1fr));

    gap:30px;
}

.card{

    position:relative;
    margin-top: 100px;
    background:rgba(255,255,255,.05);

    backdrop-filter:blur(25px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:30px;

    padding:35px;

    transition:.4s;
}

.card:hover{
    transform:
    translateY(-10px);
}

.popular{
    border:
    1px solid rgba(134,197,255,.5);

    box-shadow:
    0 0 30px rgba(134,197,255,.15);
}

.badge{

    position:absolute;

    top:-12px;
    right:20px;

    padding:8px 14px;

    border-radius:20px;

    background:#86c5ff;

    color:black;

    font-size:12px;
    font-weight:700;
}

.plan{
    font-size:28px;
    font-weight:700;
}

.price{
    margin:20px 0;
}

.price h2{
    font-size:55px;
}

.price span{
    color:var(--muted);
}

.features{
    list-style:none;
    margin:25px 0;
}

.features li{
    margin-bottom:15px;
    color:#d1d5db;
}

.btn{

    width:100%;

    padding:15px;

    border:none;

    border-radius:16px;

    cursor:pointer;

    font-weight:600;

    background:white;
    color:black;

    transition:.3s;
}

.btn:hover{
    transform:
    translateY(-3px);
}

</style>
</head>

<body>
@extends('navbar')
<nav class="nav">
    <div class="logo">NOVA</div>

    <button class="cta">
        Launch App
    </button>
</nav>



<section class="pricing">

    <div class="card">

        <h3 class="plan">Starter</h3>

        <div class="price">
            <h2>$0</h2>
            <span>Forever Free</span>
        </div>

        <ul class="features">
            <li>✓ 1 Project</li>
            <li>✓ Basic Analytics</li>
            <li>✓ Community Support</li>
            <li>✓ 1 GB Storage</li>
        </ul>

        <button class="btn">
            Get Started
        </button>

    </div>

    <div class="card popular">

        <div class="badge">
            MOST POPULAR
        </div>

        <h3 class="plan">Pro</h3>

        <div class="price">
            <h2>$19</h2>
            <span>/month</span>
        </div>

        <ul class="features">
            <li>✓ Unlimited Projects</li>
            <li>✓ Advanced Analytics</li>
            <li>✓ Priority Support</li>
            <li>✓ 50 GB Storage</li>
            <li>✓ Team Collaboration</li>
        </ul>

        <button class="btn">
            Upgrade Now
        </button>

    </div>

    <div class="card">

        <h3 class="plan">Enterprise</h3>

        <div class="price">
            <h2>$49</h2>
            <span>/month</span>
        </div>

        <ul class="features">
            <li>✓ Unlimited Everything</li>
            <li>✓ Dedicated Manager</li>
            <li>✓ API Access</li>
            <li>✓ Custom Integrations</li>
            <li>✓ 24/7 Support</li>
        </ul>

        <button class="btn">
            Contact Sales
        </button>

    </div>

</section>

</body>
</html>