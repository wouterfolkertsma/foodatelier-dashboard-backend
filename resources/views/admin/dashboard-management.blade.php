@extends('layout.base')

@section('title', 'Dashboard Management')

@section('content')
    <div class="uk-card uk-card-body">
        <!--SEARCH-FILTER-->
        @include('includes/search-bar')

        <!--ADD-BUTTON-->
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('employee.new') }}">New dashboard</a>

        <!--ZERO-RESULTS-ALERT-->
        <div class="uk-alert-warning" uk-alert  id="no-results-alert" style="display: none">
            <p>No Results.</p>
        </div>
        <!--TABLE-->
        <table class="uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
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
