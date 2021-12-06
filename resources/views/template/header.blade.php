<header>
    <div class="app-bar">
        <div class="app-bar__menu">
            <button id="hamburgerButton">☰</button>
        </div>
        <div class="app-bar__brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/pacify-logo.png') }}" alt="Logo Pacify" />
            </a>
        </div>
        <nav id="navigationDrawer" class="app-bar__navigation">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Article</a></li>
                <li><a href="#">Diary</a></li>
                @auth
                <a href="{{ route('logout') }}">
                    <button class="loginButton" style="cursor: pointer">Logout</button>
                </a>
                @endauth
                @guest
                <a href="{{ route('login') }}">
                    <button class="loginButton" style="cursor: pointer">Login</button>
                </a>
                @endguest
                <!-- <li><a href="#" id="loginButton" class="loginButton">Login</a></li> -->
            </ul>
        </nav>
    </div>

    @yield('header')
</header>