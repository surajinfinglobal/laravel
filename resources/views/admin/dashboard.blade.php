@extends('admin.navbar')

@section('content')

<div class="dashboard">

    <div class="header">

        <div>
            <h1>Dashboard</h1>
            <p>Welcome back, {{ Auth::user()->name }} 👋</p>
        </div>

        <div class="date">
            {{ date('d M Y') }}
        </div>

    </div>

    <!-- Stats Cards -->

    <div class="cards">

        <div class="card">
            <div class="icon">👥</div>

            <h2>{{ $users }}</h2>

            <span>Total Users</span>
        </div>

        <div class="card">

            <div class="icon">📩</div>

            <h2>{{ $messages }}</h2>

            <span>Messages</span>

        </div>

        <div class="card">

            <div class="icon">🚀</div>

            <h2>{{ $projects }}</h2>

            <span>Projects</span>

        </div>

        <div class="card">

            <div class="icon">📈</div>

            <h2>98%</h2>

            <span>Growth</span>

        </div>

    </div>

    <!-- Quick Actions -->

    <div class="quick">

        <h2>Quick Actions</h2>

        <div class="action-grid">

            <a href="{{ route('admin.users') }}" class="action">
                👥
                <h3>Manage Users</h3>
            </a>

            <a href="{{ route('admin.messages') }}" class="action">
                📩
                <h3>Messages</h3>
            </a>

            <a href="#" class="action">
                🚀
                <h3>Projects</h3>
            </a>

            <a href="#" class="action">
                ⚙️
                <h3>Settings</h3>
            </a>

        </div>

    </div>

</div>

<style>

.dashboard{

    width:100%;

}

.header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:40px;

}

.header h1{

    font-size:42px;

}

.header p{

    color:#94a3b8;

    margin-top:8px;

}

.date{

    color:#cbd5e1;

}

/* Cards */

.cards{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

    gap:25px;

}

.card{

    background:rgba(255,255,255,.05);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:25px;

    padding:30px;

    transition:.35s;

}

.card:hover{

    transform:translateY(-8px);

}

.icon{

    font-size:40px;

    margin-bottom:20px;

}

.card h2{

    font-size:40px;

    margin-bottom:8px;

}

.card span{

    color:#94a3b8;

}

/* Quick Actions */

.quick{

    margin-top:60px;

}

.quick h2{

    margin-bottom:25px;

}

.action-grid{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

}

.action{

    text-decoration:none;

    color:white;

    background:rgba(255,255,255,.05);

    border:1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(20px);

    border-radius:25px;

    padding:30px;

    text-align:center;

    transition:.35s;

}

.action:hover{

    transform:translateY(-8px);

    background:rgba(255,255,255,.08);

}

.action{

    font-size:40px;

}

.action h3{

    margin-top:20px;

    font-size:20px;

}

</style>

@endsection