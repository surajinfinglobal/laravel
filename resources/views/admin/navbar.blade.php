<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Inter,sans-serif;
}

body{

background:#06080d;

background:
radial-gradient(circle at top left,
rgba(255,255,255,.03),
transparent 35%),

radial-gradient(circle at bottom right,
rgba(255,255,255,.03),
transparent 35%),

#06080d;

color:white;
}

.navbar{

position:fixed;

top:25px;

left:50%;

transform:translateX(-50%);

width:min(1300px,94%);

height:75px;

display:flex;

align-items:center;

justify-content:space-between;

padding:0 25px;

border-radius:25px;

background:rgba(255,255,255,.05);

backdrop-filter:blur(25px);

border:1px solid rgba(255,255,255,.08);

z-index:999;
}

.logo{

font-size:24px;

font-weight:700;

letter-spacing:2px;
}

.logo span{

color:#3b82f6;
}

.menu{

display:flex;

gap:12px;
}

.menu a{

text-decoration:none;

color:#b5b5b5;

padding:12px 22px;

border-radius:14px;

transition:.3s;
}

.menu a:hover,
.menu a.active{

background:rgba(255,255,255,.08);

color:#fff;
}

.right{

display:flex;

align-items:center;

gap:18px;
}

.admin{

font-size:15px;

color:#ddd;
}

.logout{

padding:12px 22px;

border:none;

border-radius:14px;

cursor:pointer;

background:#ef4444;

color:white;

font-weight:600;

transition:.3s;
}

.logout:hover{

background:#dc2626;
}

.content{

margin-top:130px;

padding:30px;

width:min(1300px,94%);

margin-inline:auto;
}
.logout {
    padding: 12px 20px;
    border: none;
    border-radius: 14px;
    cursor: pointer;
    background: #ef4444;
    color: white;
    font-weight: 600;
    transition: .3s;
    display: flex;
    align-items: center;
    gap: 8px;           /* Icon aur text ke beech space */
}

.logout:hover {
    background: #dc2626;
    transform: translateY(-2px);
}

</style>

</head>

<body>

<nav class="navbar">

<div class="logo">

NOVA <span>ADMIN</span>

</div>

<div class="menu">

<a href="{{ route('admin.dashboard') }}"
class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
Dashboard
</a>

<a href="{{ route('admin.users') }}"
class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
Users
</a>

<a href="{{ route('admin.messages') }}"
class="{{ request()->routeIs('admin.messages') ? 'active' : '' }}">
Messages
</a>

<a href="{{ route('admin.projects') }}"
class="{{ request()->routeIs('admin.projects') ? 'active' : '' }}">
Projects
</a>

<a href="{{ route('admin.contact') }}"
class="{{ request()->routeIs('admin.contact') ? 'active' : '' }}">
Contact
</a>

<div class="right">

    <div class="admin">
        <i class="fa-solid fa-user" style="color: rgb(116, 192, 252);"></i> 
        {{ Auth::user()->name }}
    </div>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="logout" type="submit">
            <i class="fa-solid fa-right-from-bracket"></i> 
            Logout
        </button>
    </form>

</div>

</nav>

<div class="content">

@yield('content')

</div>

</body>
</html>