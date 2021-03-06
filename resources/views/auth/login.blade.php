@extends('layout.base-logged-out')

@section('title', 'Login')

@section('content')
    <img class="logo uk-animation-fade" src="/../images/LG_foodatelier zonder pay off-image.png">

    <div class="uk-section uk-flex uk-flex-middle uk-animation-fade uk-background-default uk-background-cover" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container uk-text-center"><h1 class= "uk-text-bold">App Name</h1>
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card-default uk-card-body">
                            <h4 class="uk-card-title uk-text-center">Welcome back!</h4>
                            {{ Form::open() }}
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
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
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                        {{ Form::password('password', ['class' => 'uk-input']) }}
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">Login</button>
                                </div>

                                <div  class="uk-text-small uk-text-center">
                                    <a class ="sublink" href="{{ route('password.request') }}"  tabindex="0" class="icon-dashboard"><span>Forgot password?</span></a>
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

