<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-top: 2rem; position: relative;">
    <button id="toggle-theme" class="btn btn-link" style="position: absolute; left: 10px; top: 10px; font-size: 1.5rem;">
        <i id="theme-icon" class="fas fa-moon" style="color: black;"></i>
    </button>


    <div id="logo-container">
        <img src="/logo.png" width="100" height="100" id="logo">
    </div>

    <h2 class="header-title d-none" id="dark-title">
        <b><span class="animated-text1">Peer</span>
            <span class="animated-text2">Jee</span>
            <span class="animated-text3">Kurta</span></b>
    </h2>
    <div class="auth">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-success">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-dark">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning">Login</a>
            @endauth
        @endif
    </div>
</nav>
