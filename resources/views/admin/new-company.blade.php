@extends('layout.base')

@section('title', 'Edit: Company')

@section('content')
    <div class="uk-card-default-tiny uk-card-body uk-margin">
        {{ Form::open(['route' => 'company.save']) }}
            <legend class="uk-legend">New Company</legend>
            <div class="uk-margin">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', '', ['class' => 'uk-input uk-form-width-medium']) }}

                {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection