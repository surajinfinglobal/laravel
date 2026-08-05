<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Project Uploaded</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Inter,sans-serif;
}

body{

height:100vh;

display:flex;
justify-content:center;
align-items:center;

background:#06080d;
color:white;

}

.card{

width:520px;

background:rgba(255,255,255,.05);

backdrop-filter:blur(20px);

border:1px solid rgba(255,255,255,.08);

border-radius:25px;

padding:40px;

}

h2{

text-align:center;
margin-bottom:35px;

}

.timeline{

display:flex;
flex-direction:column;
gap:18px;

}

.step{

display:flex;
align-items:center;

opacity:.3;

transition:.5s;

font-size:18px;

}

.step.active{

opacity:1;

color:#4ade80;

}

.icon{

width:40px;

height:40px;

display:flex;

align-items:center;

justify-content:center;

border-radius:50%;

background:#1f2937;

margin-right:15px;

font-size:20px;

}

button{

margin-top:40px;

width:100%;

padding:16px;

background:#2563eb;

border:none;

border-radius:12px;

font-size:18px;

color:white;

cursor:pointer;

display:none;

}

button:hover{

background:#1d4ed8;

}
a{
    text-decoration:none;
    color:white;
}

</style>

</head>

<body>

<div class="card">

<h2>Uploading Project</h2>

<div class="timeline">

<div class="step" id="step1">
<div class="icon">⏳</div>
Uploading Project...
</div>

<div class="step" id="step2">
<div class="icon">🖼</div>
Uploading Image...
</div>

<div class="step" id="step3">
<div class="icon">💾</div>
Saving Database...
</div>

<div class="step" id="step4">
<div class="icon">✅</div>
Project Uploaded Successfully
</div>

</div>

<button id="closeBtn">
 <a href="{{ route('home') }}" class="btn-back">Close</a>
</button>

</div>

<script>

const steps=[
'step1',
'step2',
'step3',
'step4'
];

let i=0;

function next(){

if(i<steps.length){

document
.getElementById(steps[i])
.classList.add('active');

i++;

setTimeout(next,1000);

}
else{

document
.getElementById('closeBtn')
.style.display='block';

}

}

next();

</script>

</body>

</html>