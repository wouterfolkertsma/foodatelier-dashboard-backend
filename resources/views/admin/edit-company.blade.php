@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card uk-card-body">
        {{ Form::model($company, ['route' => ['company.update', $company->id], 'class' => 'uk-form-stacked']) }}

        <fieldset class="uk-fieldset">
            <legend class="uk-legend">Edit {{ $company->name }}</legend>

            <div class="uk-margin">
                {{ Form::label('name', 'Name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('name', $company->name, ['class' => 'uk-input uk-form-width-medium']) }}
            </div>

            {{ Form::submit('Save', ['class' => 'uk-button uk-button-default']) }}
        </fieldset>

        {{ Form::close() }}
    </div>
    <hr class="uk-divider-icon">
    <div class="uk-card uk-card-body">
        <a class="uk-button uk-button-primary uk-align-right" href="{{ route('client.new', $company->id) }}">New User</a>

        <h4>Users from {{ $company->name }}</h4>
        <table class="uk-table uk-table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Status</th>
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
                    <td>{{ $user->status }}-><-SAMPLE</td>
                    <td>
                        <a href="{{ route('client.edit', ['id' => $user->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
