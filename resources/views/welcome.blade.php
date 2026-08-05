<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Welcome | NOVA</title>

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
    overflow:hidden;

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
</head>

<body>

@extends('navbar')

<div class="glass-card card1"></div>
<div class="glass-card card2"></div>

<section class="hero">

    <div class="hero-content">

        <h1>  Welcome Back
             @auth
             {{ auth()->user()->name }}
          @endauth</h1>
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

</section>

</body>
</html>