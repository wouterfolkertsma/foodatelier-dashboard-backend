@extends('layout.base')

@section('title', 'Employee Management')

@section('content')
    <div class="uk-card-default uk-card-body">
        <!--SEARCH-FILTER-->
        @include('includes/search-bar')

        <!--ADD-BUTTON-->
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('employee.new') }}">New Employee</a>

        <!--ZERO-RESULTS-ALERT-->
        <div class="uk-alert-warning" uk-alert id="no-results-alert" style="display: none">
            <p>No Results.</p>
        </div>
        <!--TABLE-->
        <table class="uk-table uk-table-striped" id="tableForm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="resultsTable">
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->user->email }}</td>
                    <td data-type="name">{{ $employee->user->getFullName() }}</td>
                    <td>{{ $employee->created_at }}</td>
                    <td>{{ $employee->updated_at }}</td>
                    <td>
                        <a href="{{ route('employee.edit', ['id' => $employee->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
