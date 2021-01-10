<div class="menu" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <div class="avatar">
        <?php
        // Get user id
        $user = Auth::user();
        ?>
        <a href="{{ route('user.edit', $user->id) }}">
            <img src="/{{ $user->avatar_url }}" />
        </a>
        <h2>{{ auth()->user()->first_name }}</h2>
    </div>
    <ul>
        @yield('links')
    </ul>
</div>
