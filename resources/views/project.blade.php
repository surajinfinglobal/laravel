<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Projects | NOVA</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Inter',sans-serif;
background:#06080d;
color:white;
min-height:100vh;

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
top:30px;
left:50%;
transform:translateX(-50%);
width:min(1200px,92vw);
height:78px;

display:flex;
justify-content:space-between;
align-items:center;

padding:0 20px;

background:rgba(255,255,255,.06);
backdrop-filter:blur(30px);

border:1px solid rgba(255,255,255,.12);

border-radius:30px;

z-index:1000;
}

.logo{
font-weight:700;
letter-spacing:4px;
}

/* Hero */

.hero{
padding-top:170px;
text-align:center;
padding-bottom:70px;
}

.hero h1{
font-size:clamp(50px,8vw,90px);
margin-bottom:20px;

background:linear-gradient(
90deg,
white,
#77bfff,
white);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.hero p{
max-width:700px;
margin:auto;
color:#9aa4b2;
line-height:1.8;
}

/* Projects */

.projects{
width:min(1200px,90%);
margin:auto;

display:grid;
grid-template-columns:
repeat(auto-fit,minmax(320px,1fr));

gap:30px;

}

.project-card{

background:
rgba(255,255,255,.05);

backdrop-filter:
blur(25px);

border:
1px solid rgba(255,255,255,.08);

border-radius:30px;

overflow:hidden;

transition:.4s;
}

.project-card:hover{
transform:
translateY(-10px);
}

.project-image{
height:220px;

background:
linear-gradient(
135deg,
#3b82f6,
#8b5cf6);

display:flex;
align-items:center;
justify-content:center;

font-size:50px;
}

.project-content{
padding:25px;
}

.project-content h3{
margin-bottom:12px;
font-size:24px;
}

.project-content p{
color:#9aa4b2;
line-height:1.7;
margin-bottom:20px;
}

.tags{
display:flex;
flex-wrap:wrap;
gap:10px;
margin-bottom:25px;
}

.tag{
padding:8px 14px;
border-radius:30px;

background:
rgba(255,255,255,.08);

font-size:13px;
}

.buttons{
display:flex;
gap:12px;
}

.btn{
flex:1;
padding:14px;
border:none;
border-radius:14px;
cursor:pointer;

font-weight:600;
}

.demo{
background:white;
color:black;
}

.github{
background:
rgba(255,255,255,.08);

color:white;

border:
1px solid rgba(255,255,255,.15);
}

</style>
</head>
<body>
@extends('navbar')
<nav class="nav">
<div class="logo">NOVA</div>
</nav>

<nav class="navbar">

    <div class="logo">
        Projects
    </div>

    <div class="nav-links">
        <a href="{{ route('projects.create') }}" class="upload-btn">
            Upload Project
        </a>
    </div>

</nav>
<section class="projects">

<!-- Project 1 -->

<div class="project-card">

<div class="project-image">
🎵
</div>

<div class="project-content">

<h3>SpotiDost</h3>

<p>
Premium music streaming platform inspired by Spotify
with playlists, lyrics, visualizer and analytics.
</p>

<div class="tags">

<span class="tag">React</span>
<span class="tag">Tailwind</span>
<span class="tag">Music</span>

</div>

<div class="buttons">

<button class="btn demo">
Live Demo
</button>

<button class="btn github">
GitHub
</button>

</div>

</div>

</div>

<!-- Project 2 -->

<div class="project-card">

<div class="project-image">
🚀
</div>

<div class="project-content">

<h3>Space Explorer</h3>

<p>
Interactive 3D universe with planets, galaxies,
black holes and immersive navigation.
</p>

<div class="tags">

<span class="tag">Three.js</span>
<span class="tag">WebGL</span>
<span class="tag">3D</span>

</div>

<div class="buttons">

<button class="btn demo">
Live Demo
</button>

<button class="btn github">
GitHub
</button>

</div>

</div>

</div>

<!-- Project 3 -->

<div class="project-card">

<div class="project-image">
💼
</div>

<div class="project-content">

<h3>Trade Network</h3>

<p>
Global B2B platform connecting suppliers,
buyers and logistics partners worldwide.
</p>

<div class="tags">

<span class="tag">Laravel</span>
<span class="tag">MySQL</span>
<span class="tag">B2B</span>

</div>

<div class="buttons">

<button class="btn demo">
Live Demo
</button>

<button class="btn github">
GitHub
</button>

</div>

</div>

</div>

</section>

<style>
 .navbar{
    position:fixed;
    top:120px;
    left:50%;
    transform:translateX(-50%);
    width:min(1200px,92vw);
    height:78px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:0 30px;

   
   
    border-radius:30px;

    z-index:1000;
}

.nav-links{
    display:flex;
    align-items:center;
    gap:20px;
}

.upload-btn{
    text-decoration:none;
    color:#fff;
    padding:12px 24px;
    border-radius:14px;

    background:linear-gradient(135deg,#3b82f6,#8b5cf6);

    font-weight:600;
    transition:.3s;
}

.upload-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(59,130,246,.35);
}
</style>
</body>
</html>