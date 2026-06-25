<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Liquid Glass Navbar</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{

    --bg:#06080d;

    --glass:
    rgba(255,255,255,.08);

    --glass-border:
    rgba(255,255,255,.14);

    --text:#ffffff;

    --muted:#9aa4b2;
}

body{

    min-height:100vh;
    overflow:hidden;
    display:flex;
    justify-content:center;
    background:
    radial-gradient(circle at top left,
    rgba(255,255,255,.03),
    transparent 30%),

    radial-gradient(circle at bottom right,
    rgba(255,255,255,.02),
    transparent 40%),

    var(--bg);

    font-family:'Inter',sans-serif;
}



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

    background:
    rgba(255,255,255,.06);

    backdrop-filter:blur(30px);

    border:
    1px solid rgba(255,255,255,.12);

    box-shadow:

    inset 0 1px 0 rgba(255,255,255,.2),

    0 20px 50px rgba(0,0,0,.35);

    z-index:1000;
}

.logo{

    color:white;

    font-weight:700;

    letter-spacing:4px;
}

.nav-menu{

    position:relative;

    display:flex;

    gap:6px;

    padding:8px;

    border-radius:20px;

    background:
    rgba(255,255,255,.03);
}

.indicator{

    position:absolute;
    left:8px;
    top:8px;
    width:90px;
    height:44px;
    border-radius:14px;
    background:
    rgba(255,255,255,.12);
    backdrop-filter:blur(30px);
    transition:
    all .55s cubic-bezier(.22,1,.36,1);
    box-shadow:
    inset 0 1px 0 rgba(255,255,255,.3),
    0 5px 20px rgba(255,255,255,.05);
}

.nav-item{

    width:90px;
    height:44px;
    position:relative;
    z-index:2;
    color:var(--muted);
    text-decoration:none;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:14px;
    transition:
    .35s cubic-bezier(.22,1,.36,1);
}

.nav-item:hover{
    color:white;
    transform:
    translateY(-3px);
}

.nav-item.active{
    color:white;
}

.cta{
    height:50px;
    padding:0 22px;
    border:none;
    border-radius:14px;
    color:white;
    cursor:pointer;
    background:
    rgba(255,255,255,.08);
    border:
    1px solid rgba(255,255,255,.15);
    backdrop-filter:blur(20px);
    transition:.35s;
}

.cta:hover{
    transform:
    translateY(-3px);
    background:
    rgba(255,255,255,.15);
}

h1{
    color:white;
    text-align:center;

}



</style>
</head>

<body>
@extends('app')

<!-- <nav class="nav">
    <div class="logo">
        NOVA
    </div>

    <div class="nav-menu">

        <div class="indicator"></div>

        <a class="nav-item active" href="{{ url('/') }}">Home</a>
        <a class="nav-item" href="{{ url('home/welcome') }}">Welcome</a>
        <a class="nav-item" href="welcome.blade.php">Welcome</a> -->
        <!-- <a class="nav-item" href="{{ url('home/project') }}">Projects</a> -->
        <!-- <a class="nav-item" href="{{url('home/pricing')}}">Pricing</a>
        <a class="nav-item" href="#">Contact</a>
        <a class="nav-item" href="{{url('home/about')}}">about</a>

    </div>

    <button class="cta">
        Launch App
    </button>
</nav> -->

<h1>home page</h1>

<script>

const items =
document.querySelectorAll(".nav-item");

const indicator =
document.querySelector(".indicator");

function moveIndicator(item){

    indicator.style.width =
    item.offsetWidth + "px";

    indicator.style.left =
    item.offsetLeft + "px";
}

moveIndicator(
document.querySelector(".active")
);

items.forEach(item=>{

    item.addEventListener("mouseenter",()=>{

        moveIndicator(item);
    });

    item.addEventListener("click",()=>{

        items.forEach(i=>
        i.classList.remove("active"));

        item.classList.add("active");

        moveIndicator(item);
    });

});

document
.querySelector(".nav-menu")
.addEventListener("mouseleave",()=>{

    moveIndicator(
    document.querySelector(".active")
    );
});

/* Mobile */



</script>

</body>
</html>