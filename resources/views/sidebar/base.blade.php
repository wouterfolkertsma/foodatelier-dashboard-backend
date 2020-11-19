<nav class="menu" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <div class="avatar">
        <img src="https://www.dovercourt.org/wp-content/uploads/2019/11/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg" />
        <h2>{{ auth()->user()->first_name }}</h2>
    </div>
    <ul>
        @yield('links')
    </ul>
    <div class="label">
        <img src="/../images/falabel.svg">
    </div>
</nav>
