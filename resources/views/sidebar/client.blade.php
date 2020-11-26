@extends('sidebar.base')

@section('links')

    <a class="menu-submenu" href="{{ route('client-manager') }}">
        <a class="menu-link" href="{{ route('client-dashboard') }}">
            <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-dashboard.svg">Dashboard</span>
        </a>
        <ul>
            <a class="menu-link" href="{{ route('client-personal-insights') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Personal Insights</span></li>
            </a>

            <a class="menu-link" href="{{ route('client-newsfeed') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Newsfeed</span></li>
            </a>

            <a class="menu-link" href="{{ route('client-trends') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Trends</span></li>
            </a>

            <a class="menu-link" href="{{ route('client-social-media') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Social Media</span></li>
            </a>
        </ul>
        </li>
    </a>


@endsection
