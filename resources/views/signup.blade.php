@extends('navbar')

<!-- @section('title','Signup') -->

@section('content')
<div class="signup-wrapper">

    <div class="signup-card">

        <h1>Create Account</h1>

        @if(session('success'))
             <div class="success-message">
        {{ session('success') }}
    </div>
        @endif
@if ($errors->any())

    <div class="error-message">

        @foreach ($errors->all() as $error)

            <p>{{ $error }}</p>

        @endforeach

    </div>

@endif
        <form method="POST" action="{{ route('signup.store') }}">

            @csrf

            <div class="input-group">
                <input class="enter"
                    type="text"
                    name="name"
                    placeholder="Full Name"
                   >
            </div>

            <div class="input-group">
                <input class="enter"
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    >
            </div>

            <div class="input-group">
                <input class="enter"
                    type="password"
                    name="password"
                    placeholder="Password"
                    >
            </div>

            <button class="btn" type="submit">
                Create Account
            </button>

        </form>

    </div>

</div>
<script>
setTimeout(() => {
    const msg = document.querySelector('.success-message');
    if(msg){
        msg.style.opacity = '0';
        setTimeout(() => msg.remove(), 500);
    }
}, 3000);

setTimeout(() => {
    const errorMsg = document.querySelector('.error-message');

    if(errorMsg){

        errorMsg.style.opacity = '0';

        setTimeout(() => {
            errorMsg.remove();
        }, 500);
    }

}, 3000);
</script>
<style>

.error-message{
    background: rgba(255,0,0,.15);
    border: 1px solid rgba(255,0,0,.3);
    color: #ffb3b3;
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 20px;
}

.error-message p{
    margin: 5px 0;
}
.signup-wrapper{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.success-message{
    background: rgba(0,255,100,.15);
    border: 1px solid rgba(0,255,100,.3);
    color: #7dffb0;
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 20px;
    text-align: center;
}
.signup-card{

    width:450px;

    background:
    rgba(255,255,255,.05);

    backdrop-filter:
    blur(25px);

    border:
    1px solid rgba(255,255,255,.08);

    border-radius:30px;

    padding:40px;
}

.signup-card h1{
    text-align:center;
    margin-bottom:30px;
}

.input-group{
    margin-bottom:20px;
}

.input-group .enter{

    width:100%;

    height:55px;

    border:none;

    outline:none;

    border-radius:15px;

    padding:0 20px;

    color:white;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);
}

.btn{

    width:100%;

    height:55px;

    border:none;

    cursor:pointer;

    border-radius:15px;

    font-size:16px;

    font-weight:600;

    background:white;

    color:black;
}

.success{

    background:
    rgba(0,255,100,.15);

    border:
    1px solid rgba(0,255,100,.3);

    padding:15px;

    border-radius:15px;

    margin-bottom:20px;
}

</style>
