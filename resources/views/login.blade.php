{{--<form action="login" method="post">--}}
{{--<input type="text" name="user">--}}
{{--<input type="text" name="password">--}}
{{--@csrf--}}
{{--<button type="submit" >login</button>--}}
{{--</form>--}}

@extends('layout.base')

@section('title', 'Login')

@section('sidebar')
{{--    @parent--}}
@endsection

@section('content')
    <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Welcome back!</h3>
                            {{ Form::open(['action' => $postAction]) }}
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                        {{ Form::text('username', '', ['class' => 'uk-input']) }}
                                    </div>
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
                                <div class="uk-text-small uk-text-center">
                                    Forgot password?
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

