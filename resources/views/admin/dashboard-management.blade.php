@extends('layout.base')

@section('title', 'Dashboard Management')

@section('content')

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
<script src="replace"> </script>
    <style>
        .filter{
            position: absolute;
            border: solid black 1px;
            border-radius: 2px;
            background-color : white;
            padding: 8px;
            display:none;
        }
    </style>

    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
        @include('includes/search-bar')

        <!--ADD-BUTTON-->
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('employee.new') }}">New dashboard</a>

        <!--ZERO-RESULTS-ALERT-->
        <div class="uk-alert-warning" uk-alert  id="no-results-alert" style="display: none">
            <p>No Results.</p>
        </div>
        <!--TABLE-->
        <table class="filterTable uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th >ID<div class="filter"></div></th>
                <th class="filterButton" index=1>Name<div class="filter"></div></th>
                <th class="filterButton" index=2>Date Created<div class="filter"></div></th>
                <th class="filterButton" index=3>Date Updated<div class="filter"></div></thindex>
                <th ><!--class="filterButton" index=4-->Action<div class="filter"></div></th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($dashboards as $dashboard)
                <tr>
                    <td>{{ $dashboard->id }}</td>
                    <td data-type="name">{{ $dashboard->name }}</td>
                    <td>{{ $dashboard->created_at }}</td>
                    <td>{{ $dashboard->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.edit', ['id' => $dashboard->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
