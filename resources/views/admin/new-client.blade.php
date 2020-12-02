@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card-default uk-card-body">
        {{ Form::open(['route' => ['client.save', $companyId], 'class' => 'uk-form-stacked']) }}
        <fieldset class="uk-fieldset">
            <legend class="uk-legend">New client</legend>
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

            {{ Form::hidden('company_id', $companyId) }}
            {{ Form::hidden('role_id', $role->id) }}

            {{ Form::submit('Save', ['class' => 'uk-button uk-button-primary']) }}
        </fieldset>
        {{ Form::close() }}
    </div>
@endsection