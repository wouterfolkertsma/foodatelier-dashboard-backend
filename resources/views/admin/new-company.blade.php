@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card-default-small uk-card-body">
        {{ Form::open(['route' => 'company.save']) }}
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', '', ['class' => 'uk-input uk-form-width-medium']) }}

            {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary']) }}
        {{ Form::close() }}
    </div>
@endsection