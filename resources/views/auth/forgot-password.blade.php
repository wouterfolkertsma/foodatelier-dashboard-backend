@extends('layout.base-logged-out')

@section('title', 'Login')

@section('content')
    <img class="logo uk-animation-fade" src="/../images/LG_foodatelier zonder pay off-image.png">

    <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade uk-background-default uk-background-cover" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card-default uk-card-body">
                            <h3 class="uk-card-title uk-text-center">Reset password!</h3>
                            @if(session('status'))
                                <div class="alert uk-alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @csrf
                            {{ Form::open(['route' => 'password.request']) }}
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1 uk-margin">
                                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                        {{ Form::text('email', '', ['class' => 'uk-input']) }}
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="uk-margin">
                                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">Reset</button>
                                </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

