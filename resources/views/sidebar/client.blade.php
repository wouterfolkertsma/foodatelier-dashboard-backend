@extends('sidebar.base')

@section('links')
    <a class="menu-submenu" href="{{ route('client-manager') }}">
        <a class="menu-link" href="{{ route('client-dashboard') }}">
            <span tabindex="0" class="icon-dashboard"><img src="/../images/icons/icon-dashboard.svg">Dashboard</span>
        </a>
        <ul>
            <li tabindex="0" class="icon-dashboard sublink">
                <a class="menu-link" href="{{ route('client-personal-insights') }}">Personal insights</a>
            </li>

            <li tabindex="0" class="icon-dashboard sublink">
                <a class="menu-link" href="{{ route('client-newsfeed') }}">Newsfeed</a>
            </li>

            <li tabindex="0" class="icon-dashboard sublink">
                <a class="menu-link" href="{{ route('client-trends') }}">Trends</a>
            </li>

            <li tabindex="0" class="icon-dashboard sublink">
                <a class="menu-link" href="{{ route('client-social-media') }}">Social Media</a>
            </li>

            <li tabindex="0" class="icon-dashboard sublink">
                <a class="menu-link" href="{{ route('client-files') }}">Files</a>
            </li>

            <li tabindex="0" class="icon-dashboard sublink">
                <a class="menu-link" href="{{ route('rss.index') }}">RSS Feeds</a>
            </li>
        </ul>
    </a>
@endsection
