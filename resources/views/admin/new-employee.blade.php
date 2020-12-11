@extends('layout.base')

@section('title', 'Edit: Employee')

@section('content')
    <div class="uk-card-default-small uk-card-body">
        {{ Form::open(['route' => ['employee.save'], 'class' => 'uk-form-stacked']) }}
        <fieldset class="uk-fieldset">
            <legend class="uk-legend">New employee</legend>
            <div class="uk-margin">
                {{ Form::label('first_name', 'First name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('first_name', '', ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <div class="uk-margin">
                {{ Form::label('last_name', 'Last name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('last_name', '', ['class' => 'uk-input uk-form-width-large']) }}

            </div>
            <div class="uk-margin">
                {{ Form::label('email', 'Email:', ['class' => 'uk-form-label']) }}
                {{ Form::text('email', '', ['class' => 'uk-input uk-form-width-large']) }}
            </div>


            {{ Form::hidden('role_id', $role->id) }}

            {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary']) }}
        </fieldset>
        {{ Form::close() }}
    </div>
@endsection
