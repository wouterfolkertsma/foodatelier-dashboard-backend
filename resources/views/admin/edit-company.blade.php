@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card uk-card-body">

    </div>
    <div class="uk-card uk-card-body">
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
                        <a href="{{ route('edit-company', ['id' => $company->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection