<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('img/pacify-icon.png') }}" rel="icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/responsive-index.css') }}" />
</head>

<body>
    <a href="{{ route('chat') }}">
        <button class="chatButton">
            <img src="{{ asset('img/chatButton.png') }}" alt="" />
        </button>
    </a>

    @include('template.header')

    @yield('main-content')

    <footer>
        <p>© Pacify 2021. All rights reserved</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            
        })
        function toggleResponsive(){
            document.getElementById("navigationDrawer").classList.toggle("active");
        }
    </script>

    @yield('script')
</body>

</html>