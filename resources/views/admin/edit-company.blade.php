@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card uk-card-body">
        {{ Form::model($company, ['route' => ['company.update', $company->id]]) }}
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', '', ['class' => 'uk-input uk-form-width-medium']) }}

            {{ Form::submit('Save', ['class' => 'uk-button uk-button-default']) }}
        {{ Form::close() }}
    </div>
    <hr class="uk-divider-icon">
    <div class="uk-card uk-card-body">
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('client.new') }}">New User</a>

        <h4>Users from {{ $company->name }}</h4>
        <table class="uk-table uk-table-striped">
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
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->user->email }}</td>
                    <td>{{ $user->user->getFullName() }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <a href="{{ route('company.update', ['id' => $company->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection