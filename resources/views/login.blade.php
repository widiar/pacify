@extends('template.master')

@section('title', 'Sign In')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login-register.css') }}" />
@endsection

@section('main-content')
<section>
    <div class="container">
        <div class="user signinBox">
            <div class="formBox">
                <form action="">
                    <h2>SIGN IN</h2>
                    <input type="text" placeholder="Username">
                    <input type="password" placeholder="Password">
                    <input type="submit" value="Login">
                    <p class="signup">DON'T HAVE AN ACCOUNT? <a href="#" onclick="toggleForm()">SIGN UP.</a></p>
                </form>
            </div>
            <div class="imgBox">
                <img src="{{ asset('img/login.jpg') }}" alt="" class="imageBox">
            </div>
        </div>

        <div class="user registerBox">
            <div class="imgBox">
                <img src="{{ asset('img/register.jpg') }}" alt="" class="imageBox">
            </div>
            <div class="formBox">
                <form action="">
                    <h2>CREATE AN ACCOUNT</h2>
                    <input type="text" placeholder="Username">
                    <input type="text" placeholder="Email Address">
                    <input type="password" placeholder="Create Password">
                    <input type="password" placeholder="Confirm Password">
                    <input type="submit" value="Register">
                    <p class="signup">ALREADY HAVE AN ACCOUNT? <a href="#" onclick="toggleForm()">SIGN IN.</a></p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function toggleForm(){
        section = document.querySelector('section');
        container = document.querySelector('.container');
        container.classList.toggle('active');
        section.classList.toggle('active');
    }
</script>
@endsection