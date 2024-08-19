<style>
    @keyframes colorChange1 {
        0%, 100% { color: red; }
        33% { color: blue; }
        66% { color: green; }
    }

    @keyframes colorChange2 {
        0%, 100% { color: blue; }
        33% { color: green; }
        66% { color: red; }
    }

    @keyframes colorChange3 {
        0%, 100% { color: green; }
        33% { color: red; }
        66% { color: blue; }
    }

    .main-header {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 10px;
        position: relative; /* This allows the auth section to be positioned absolutely */
    }

    .header-title {
        font-size: 2em;
        text-shadow: 0px 0px 8px rgba(0,0,0,0.5);
        text-align: center;
    }

    .auth {
        position: absolute;
        right: 10px; /* Aligns the auth section to the right */
        display: flex;
        gap: 10px;
    }

    .animated-text3 {
        animation: colorChange1 1s infinite;
    }

    .animated-text2 {
        animation: colorChange2 1s infinite;
    }

    .animated-text1 {
        animation: colorChange3 1s infinite;
    }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-top: 2rem">
    <h2 class="header-title">
        <b><span class="animated-text1">Peer</span> <span class="animated-text2">Jee</span> <span class="animated-text3">Kurta</span></b>
    </h2>
    <div class="auth">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-success">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-dark">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning">
                    Login
                </a>
            @endauth
        @endif
    </div>
</nav>
