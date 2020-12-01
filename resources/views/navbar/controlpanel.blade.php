@extends('navbar.base')

@section('options')
    <a class="options-link" href="{{ route('employee-manager') }}">
        <li tabindex="0" class="icon-dashboard"><span>Employee Management</span></li>
    </a>

    <a class="options-link" href="{{ route('client-manager') }}">
        <li tabindex="0" class="icon-dashboard"><span>Client Management</span></li>
    </a>
@endsection
