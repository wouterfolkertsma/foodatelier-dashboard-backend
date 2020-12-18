<nav class="navbar" tabindex="0">
    <h4 class="page-title">@yield('title')</h4>
    <h3 class="page-title uk-legend">@yield('title')</h3>
    <a class="nav-link" href="{{ route('messenger-inbox') }}">
        <span uk-icon="comments"></span>
        <span>Messenger</span>
    </a>
    <div class="navbar-buttons">
        <div class="button-logout">
            <a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="uk-icon-button uk-icon" uk-icon="sign-out"></span>
            </a>
            <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none">
                @csrf
            </form>
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener("scroll",function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY >0);
        })
    </script>
</nav>
