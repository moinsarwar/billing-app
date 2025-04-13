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
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .header-title {
        font-size: 1.5em;
        text-shadow: 0px 0px 8px rgba(0,0,0,0.5);
        flex-grow: 1;
        text-align: center;
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
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-top: 5rem">
    <img src="/logo.png" width="100" height="100">
{{--    <h2 class="header-title">--}}
{{--        <b><span class="animated-text1">Peer</span> <span class="animated-text2">Jee</span> <span class="animated-text3">Kurta</span></b>--}}
{{--    </h2>--}}
</nav>
