<header>
    <div class="app-bar">
        <div class="app-bar__menu">
            <button id="hamburgerButton" onclick="toggleResponsive()">☰</button>
        </div>
        <div class="app-bar__brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/pacify-logo.png') }}" alt="Logo Pacify" />
            </a>
        </div>
        <nav id="navigationDrawer" class="app-bar__navigation">
            <ul>
                <li><a href="{{ route('home') }}" onclick="toggleResponsive()">Home</a></li>
                <li><a href="{{ route('articles') }}" onclick="toggleResponsive()">Article</a></li>
                <li><a href="{{ route('diaries') }}" onclick="toggleResponsive()">Diary</a></li>
                @auth
                <li>
                    <a href="{{ route('logout') }}">
                        <button class="loginButton" onclick="toggleResponsive()" style="cursor: pointer">Logout</button>
                    </a>
                </li>
                @endauth
                @guest
                <li>
                    <a href="{{ route('login') }}">
                        <button class="loginButton" onclick="toggleResponsive()" style="cursor: pointer">Login</button>
                    </a>
                </li>
                @endguest
                <!-- <li><a href="#" id="loginButton" class="loginButton">Login</a></li> -->
            </ul>
        </nav>
    </div>

    @yield('header')
</header>