@extends('layout.base')

@section('title', 'Edit company')

@section('content')
    <div class="uk-card uk-card-body">
        {{ Form::model($client, ['route' => ['client.update', $client->id], 'class' => 'uk-form-stacked']) }}
        <fieldset class="uk-fieldset">
            <legend class="uk-legend">Edit {{ $client->user->first_name }}</legend>
            <div class="uk-margin">
                {{ Form::label('first_name', 'First name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('first_name', $client->user->first_name, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <div class="uk-margin">
                {{ Form::label('last_name', 'Last name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('last_name', $client->user->last_name, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <div class="uk-margin">
                {{ Form::label('email', 'Email:', ['class' => 'uk-form-label']) }}
                {{ Form::email('email', $client->user->email, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <!--SAVE-BUTTON-->
            <div class="save_button_area">
                <div class="save_button">
                    {{ Form::submit('Save', ['class' => 'uk-button uk-button-default']) }}
                </div>
            </div>
            <!--DELETE-BUTTON-->
            <a class="uk-button uk-button-danger" onclick="window.jsAlertDeleteConfirm('{{ route('client.delete', ['id' => $client->id]) }}')">Delete Client-Account
            </a>

        </fieldset>
        {{ Form::close() }}
    </div>
@endsection
