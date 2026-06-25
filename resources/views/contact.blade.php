@extends('navbar')

@section('title','Contact Us')

 
<style>

.contact-section{
    width:min(1200px,92vw);
    margin:auto;
    padding:40px 0 80px;
}

.contact-header{
    text-align:center;
    /* margin-bottom:60px; */
}
h3{
    color:white;
}
.contact-header h1{
    font-size:clamp(50px,8vw,90px);
    font-weight:800;

    background:linear-gradient(
        90deg,
        #fff,
        #86c5ff,
        #fff
    );

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;

    margin-bottom:20px;
}

.contact-header p{
    color:#9aa4b2;
    max-width:650px;
    margin:auto;
    line-height:1.8;
}

.contact-container{
    display:grid;
    grid-template-columns:1fr 1.2fr;
    gap:30px;
}

.glass-card{
    background:rgba(255,255,255,.05);
    backdrop-filter:blur(25px);
    border:1px solid rgba(255,255,255,.08);
    border-radius:30px;
    padding:35px;
}

.info-box{
    margin-bottom:25px;
}

.info-box h3{
    margin-bottom:10px;
    font-size:20px;
}

.info-box p{
    color:#9aa4b2;
}

.contact-form{
    display:flex;
    flex-direction:column;
    gap:20px;
}

.contact-form input,
.contact-form textarea{

    width:100%;

    padding:18px 20px;

    border:none;

    outline:none;

    border-radius:15px;

    color:white;

    background:rgba(255,255,255,.05);

    border:1px solid rgba(255,255,255,.08);
}

.contact-form textarea{
    min-height:160px;
    resize:none;
}

.contact-form button{

    height:55px;

    border:none;

    border-radius:15px;

    cursor:pointer;

    font-weight:600;

    background:white;

    color:black;

    transition:.3s;
}

.contact-form button:hover{
    transform:translateY(-3px);
}

.socials{
    display:flex;
    gap:12px;
    margin-top:20px;
}

.socials a{
    text-decoration:none;
    color:white;

    padding:10px 15px;

    border-radius:12px;

    background:rgba(255,255,255,.06);

    border:1px solid rgba(255,255,255,.08);
}
.success-box{
    background:rgba(0,255,100,.15);
    border:1px solid rgba(0,255,100,.3);
    color:#8cffbc;
    padding:15px;
    border-radius:15px;
    margin-bottom:20px;
}

@media(max-width:900px){

    .contact-container{
        grid-template-columns:1fr;
    }

}
</style>

<section class="contact-section">

    <div class="contact-header">

        <h1>Contact Us</h1>

        <p>
            Have a question, suggestion, or project idea?
            We'd love to hear from you.
        </p>

    </div>

    <div class="contact-container">

        <!-- Left Side -->

        <div class="glass-card">

            <div class="info-box">
                <h3>📍 Address</h3>
                <p>Ahmedabad, Gujarat, India</p>
            </div>

            <div class="info-box">
                <h3>📧 Email</h3>
                <p>hello@nova.com</p>
            </div>

            <div class="info-box">
                <h3>📞 Phone</h3>
                <p>+91 98765 43210</p>
            </div>

            <div class="info-box">
                <h3>🕒 Working Hours</h3>
                <p>Mon - Sat : 9:00 AM - 7:00 PM</p>
            </div>

            <div class="socials">
                <a href="#">Instagram</a>
                <a href="#">LinkedIn</a>
                <a href="#">GitHub</a>
            </div>

        </div>

        <!-- Right Side -->

        <div class="glass-card">
@if(session('success'))

<div class="success-box">
    {{ session('success') }}
</div>

@endif
          <form
    class="contact-form"
    method="POST"
    action="{{ route('contact.store') }}">
    @csrf
                <input
                    type="text"
                     name="name"
                    placeholder="Your Name">

                <input
                    type="email"
                     name="email"
                    placeholder="Email Address">

                <input
                    type="text"
                     name="subject"
                    placeholder="Subject">

                <textarea   name="message"
                    placeholder="Write your message..."></textarea>

                <button type="submit">
                    Send Message
                </button>

            </form>

        </div>

    </div>

</section>
