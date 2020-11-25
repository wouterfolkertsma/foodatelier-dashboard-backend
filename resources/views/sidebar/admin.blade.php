@extends('sidebar.base')

@section('links')
    <a class="menu-link" href="{{ route('employee-manager') }}">
        <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-controlpanel.svg">Controlpanel</span></li>
    </a>
    <a class="menu-submenu" href="{{ route('client-manager') }}">
        <a class="menu-link" href="{{ route('client-manager') }}">
            <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-dashboard.svg">Dashboard</span>
        </a>
        <ul>
            <a class="menu-link" href="{{ route('client-manager') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Personal Insights</span></li>
            </a>

            <a class="menu-link" href="{{ route('client-manager') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Newsfeed</span></li>
            </a>

            <a class="menu-link" href="{{ route('client-manager') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Trends</span></li>
            </a>

            <a class="menu-link" href="{{ route('client-manager') }}">
                <li class ="sublink" tabindex="0" class="icon-dashboard"><span>Social Media</span></li>
            </a>
        </ul>
        </li>
    </a>
    <a class="menu-link" href="{{ route('employee-manager') }}">
        <li tabindex="0" class="icon-dashboard"><span><img src="/../images/icons/icon-editor.svg">Insights Editor</span></li>
    </a>

@endsection
