@extends('layout.base')

@section('title', 'Edit: Employee')

@section('content')
    <div class="uk-card-default-small uk-card-body">
        {{ Form::model($employee, ['route' => ['employee.update', $employee->id], 'class' => 'uk-form-stacked']) }}
        <fieldset class="uk-fieldset">
            <legend class="uk-legend">Edit {{ $employee->user->first_name }}</legend>
            <div class="uk-margin">
                {{ Form::label('first_name', 'First name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('first_name', $employee->user->first_name, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <div class="uk-margin">
                {{ Form::label('last_name', 'Last name:', ['class' => 'uk-form-label']) }}
                {{ Form::text('last_name', $employee->user->last_name, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <div class="uk-margin">
                {{ Form::label('email', 'Email:', ['class' => 'uk-form-label']) }}
                {{ Form::email('email', $employee->user->email, ['class' => 'uk-input uk-form-width-large']) }}
            </div>


            <!--JOB-INFORMATIONS-->
            <!--consulting_phone-->
            <div class="uk-margin">
                {{ Form::label('consulting_phone', 'consulting_phone:', ['class' => 'uk-form-label']) }}
                {{ Form::text('consulting_phone', $employee->user->consulting_phone, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <!--consulting_email-->
            <div class="uk-margin">
                {{ Form::label('consulting_email', 'consulting_email:', ['class' => 'uk-form-label']) }}
                {{ Form::email('consulting_email', $employee->user->consulting_email, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <!--job_description-->
            <div class="uk-margin">
                {{ Form::label('job_description', 'job_description:', ['class' => 'uk-form-label']) }}
                {{ Form::text('job_description', $employee->user->job_description, ['class' => 'uk-input uk-form-width-large']) }}
            </div>
            <!--SAVE-BUTTON-->
            <div class="button_area">
                <div class="save_button">
                    {{ Form::submit('Save', ['class' => 'uk-button uk-button-secondary']) }}
                </div>
            
                <!--DELETE-BUTTON-->
                <a class="delete_button uk-button uk-button-primary"   onclick="window.jsAlertDeleteConfirm('{{ route('employee.delete', ['id' => $employee->id]) }}')">Delete Employee-Account
                </a>
            </div>
        </fieldset>
        {{ Form::close() }}
    </div>


@endsection
