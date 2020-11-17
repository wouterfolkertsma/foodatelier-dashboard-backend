@extends('sidebar.base')

@section('links')
    <a class="menu-link" href="{{ route('employee-manager') }}">
        <li tabindex="0" class="icon-dashboard"><span>Employee Management</span></li>
    </a>
    <a class="menu-link" href="{{ route('client-manager') }}">
        <li tabindex="0" class="icon-dashboard"><span>Client Management</span></li>
    </a>
@endsection