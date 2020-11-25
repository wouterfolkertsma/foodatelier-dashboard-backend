@extends('layout.base')

@section('title', 'Client Management')

@section('content')
    <div class="uk-card uk-card-body">
        <div class="uk-search uk-search-default">
            <span uk-search-icon></span>
            <input class="uk-search-input" type="search" placeholder="">
        </div>
    </div>
    <div class="uk-card uk-card-body">
        <table class="uk-table uk-table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
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