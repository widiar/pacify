@extends('template.master')

@section('title', 'Sign In')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login-register.css') }}" />
@endsection

@section('main-content')
<section>
    <div class="container">
        @if(session('success'))
        <div class="alert-success" style="display: none;">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert-error" style="display: none;">
            {{ session('error') }}
        </div>
        @endif
        <div class="user signinBox">
            <div class="formBox">
                <form action="{{ route('_login') }}" method="POST">
                    @csrf
                    <h2>SIGN IN</h2>
                    <div class="input"></div>
                    <input required name="username" type="text" placeholder="Username">
                    <input required name="password" type="password" placeholder="Password">
                    <input type="submit" value="Login">
                    <p class="signup">DON'T HAVE AN ACCOUNT? <a href="#register" onclick="toggleForm()">SIGN UP.</a></p>
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
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <h2>CREATE AN ACCOUNT</h2>
                    <div class="input">
                        @error('username')
                        <small class="err" style="color: red">{{ $message }}</small>
                        @enderror
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                    </div>
                    <div class="input">
                        @error('email')
                        <small class="err" style="color: red">{{ $message }}</small>
                        @enderror
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email Address">
                    </div>
                    <div class="input">
                        @error('password')
                        <small class="err" style="color: red">{{ $message }}</small>
                        @enderror
                        <input type="password" name="password" placeholder="Create Password">
                    </div>
                    <div class="input">
                        @error('password2')
                        <small class="err" style="color: red">{{ $message }}</small>
                        @enderror
                        <input type="password" name="password2" placeholder="Confirm Password">
                    </div>
                    <input type="submit" value="Register">
                    <p class="signup">ALREADY HAVE AN ACCOUNT? <a href="#login" onclick="toggleForm()">SIGN IN.</a></p>
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

    $(document).ready(function(){
        const hash = window.location.hash
        if (hash == '#register') {
            $('section').addClass('active')
            $('.container').addClass('active')
        } else {
            $('section').removeClass('active')
            $('.container').removeClass('active')
        }

        const alertSucces = $('.alert-success')
        if(alertSucces.text() != '') {
            Swal.fire({
                title: 'Success!',
                text: alertSucces.text(),
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            })
        }

        const alertError = $('.alert-error')
        if(alertError.text() != '') {
            Swal.fire({
                title: 'Oops!',
                text: alertError.text(),
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })

</script>
@endsection