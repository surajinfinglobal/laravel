@extends('navbar')


@section('content')

<div class="login-container">

    <div class="login-card">

        <h1>Welcome Back</h1>

        <p>Sign in to your account</p>

        @if(session('error'))
            <div class="error-box">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-box">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST"
              action="{{ route('login.store') }}">

            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email Address"
                value="{{ old('email') }}">

            <input
                type="password"
                name="password"
                placeholder="Password">

            <button type="submit">
                Login
            </button>

        </form>

        <div class="signup-link">
            Don't have an account?
            <a href="{{ route('signup') }}">
                Create Account
            </a>
        </div>

    </div>

</div>
<script>
    setTimeout(() => {
        const msg =document.querySelector('.error-box');
        if(msg){
            msg.style.opacity = '0';
            setTimeout(() => {
                msg.remove();
            }, 500);
        }
    }, 3000);
</script>
<style>

.login-container{

    min-height:80vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding-top:120px;
}

.login-card{

    width:450px;

    padding:40px;

    border-radius:30px;

    background:rgba(255,255,255,.05);

    backdrop-filter:blur(25px);

    border:1px solid rgba(255,255,255,.08);

    box-shadow:
        0 20px 50px rgba(0,0,0,.25);
}

.login-card h1{
    text-align:center;
    color:white;
    margin-bottom:10px;
}

.login-card p{
    text-align:center;
    color:#9aa4b2;
    margin-bottom:25px;
}

form{
    display:flex;
    flex-direction:column;
    gap:18px;
}

input{

    width:100%;

    padding:16px;

    border:none;

    outline:none;

    border-radius:14px;

    color:white;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);
}

button{

    height:55px;

    border:none;

    cursor:pointer;

    border-radius:14px;

    font-weight:600;

    background:white;

    transition:.3s;
}

button:hover{
    transform:translateY(-3px);
}

.signup-link{

    text-align:center;

    margin-top:20px;

    color:#9aa4b2;
}

.signup-link a{
    color:white;
    text-decoration:none;
}

.error-box{

    padding:15px;

    border-radius:14px;

    margin-bottom:15px;

    color:#ffb3b3;

    background:
    rgba(255,0,0,.15);

    border:
    1px solid rgba(255,0,0,.25);
}

</style>

@endsection