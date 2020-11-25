<nav class="navbar" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <div class = "navbar-border"></div>

    <ul>
        @yield('options')
    </ul>
    <div class="button-logout">
        <div class="button-logout morph-button-round morph-drop-shadow">
            <div class="button-logout morph-button-round morph-insert-shadow">
                <a class="logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="/../images/icons/icon-logout.svg">
                </a>
                <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none">
                    @csrf
                </form>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        window.addEventListener("scroll",function (){
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY >0);
        })
    </script>
</nav>
