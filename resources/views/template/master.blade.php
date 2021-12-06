<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/responsive-index.css') }}" />
    <script>
        function openChat(url) {
                window.location = url;
            }
    </script>
</head>

<body>
    <button class="chatButton">
        <img src="{{ asset('img/chatButton.png') }}" alt="" />
    </button>

    @include('template.header')

    @yield('main-content')

    <footer>
        <p>© Pacify 2021. All rights reserved</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')
</body>

</html>