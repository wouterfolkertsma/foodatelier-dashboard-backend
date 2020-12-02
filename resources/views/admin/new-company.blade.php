@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card-default uk-card-body">
        {{ Form::open(['route' => 'company.save']) }}
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', '', ['class' => 'uk-input uk-form-width-medium']) }}

            {{ Form::submit('Save', ['class' => 'uk-button uk-button-primary']) }}
        {{ Form::close() }}
    </div>
@endsection