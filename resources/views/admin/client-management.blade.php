@extends('layout.base')

@section('title', 'Client Management')

@section('content')
    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
        @include('includes/search-bar')

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

        <!--ADD-BUTTON-->
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('company.new') }}">New company</a>

        <!--ZERO-RESULTS-ALERT-->
        <div class="uk-alert-warning" uk-alert id="no-results-alert" style="display: none">
            <p>No Results.</p>
        </div>
        <!--TABLE-->
        <table class="filterTable uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th class="filterButton" index=1>Name</th>
                <th class="filterButton" index=2>Date Created</th>
                <th class="filterButton" index=3>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td data-type="name">{{ $company->name }}</td>
                    <td>{{ $company->created_at }}</td>
                    <td>{{ $company->updated_at }}</td>
                    <td>
                        <a href="{{ route('company.edit', ['id' => $company->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
