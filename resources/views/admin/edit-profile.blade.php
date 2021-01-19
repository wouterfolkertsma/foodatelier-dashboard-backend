@extends('layout.base')

@section('title', 'Edit profile')

@section('content')

    <style>
        .two-divs{
            width: 50%;
            height: 50vh;
            /*background-color: red;*/
            margin: 0 auto;
        }
        .single-div{
            width: 40%;
            height: 50vh;
            display: inline-block;
            top: 0px;
        }
        .new-pic{
            position: relative;
            background-color: #e9e9e9;
            /*left: 50vw;*/
            border: solid red 2px;
            padding: 16px;
            display: none;
        }
        .header-bg{
            color: white;
            background-color: #969696;
            padding-left: 8px;
        }
    </style>

    <div class="uk-card uk-card-body">
{{--        {{ Form::model($client, ['route' => ['client.update', $client->id], 'class' => 'uk-form-stacked']) }}--}}
        <fieldset class="uk-fieldset">
{{--            <legend class="uk-legend">ID -> {{ $user->first_name }}</legend>--}}

{{--            BLOCK PICTURE--}}

            <div class="two-divs">

                <div class="single-div">
{{--                    <div class="container">--}}
{{--                        <div class="row">--}}
                            <div class="col-md-10 col-md-offset-1">
                                <form id="uploadPicForm" enctype="multipart/form-data" action="{{ route('user.updateAvatar', $user->id) }}" method="POST" class="new-pic">
                                    <label>Update Profile Image</label><br>
                                    <input type="file" name="avatar">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                                </form>
        {{--                        <img src="/uploads/avatars/{{ $user->avatar_url }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">--}}
                                <h2 class="header-bg"><!--{{ $user->first_name }}'s--> Profilephoto <button class="uk-button-primary" style="font-size: 1.5rem; height: 1.75em; float: right;" onclick="showPicUpload()">Edit</button></h2>
                                <img src="/{{ $user->avatar_url }}" style="border-radius:50%; margin-right:25px;">
{{--                                style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;--}}

                            </div>
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


{{--                BLOCK CONTACT--}}

                <div class="single-div" style="float:right; padding-top: 2.5em;">
                    <h2 class="header-bg">Contact:  <button class="uk-button-primary" style="font-size: 1.5rem; height: 1.75em; float: right;" onclick="triggerchangeContact()">Edit</button></h2>
                    <div class="uk-margin">
                        {{ Form::label('phone', 'Phone:', ['class' => 'uk-form-label']) }}
                        {{ Form::email('phone', $user->phone, ['class' => 'uk-input uk-form-width-large', 'id'=>'phone']) }}

                        {{ Form::label('email', 'Email:', ['class' => 'uk-form-label']) }}
                        {{ Form::email('email', $user->email, ['class' => 'uk-input uk-form-width-large', 'id'=>'email']) }}
                    </div>
                </div>
{{--                End two divs--}}
            </div>
{{--            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">--}}

{{--            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
{{--                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">--}}
{{--                {{ Auth::user()->name }} <span class="user_img"></span>--}}
{{--            </a>--}}


            <div class="two-divs">
                <div class="single-div">
                    <h2 class="header-bg">Name:  <button class="uk-button-primary" style="font-size: 1.5rem; height: 1.75em; float: right;" onclick="triggerchangeName()">Edit</button></h2>
{{--                    BLOCK NAME--}}
                    <div class="uk-margin">
                        {{ Form::label('first_name', 'First name:', ['class' => 'uk-form-label']) }}
                        {{ Form::text('first_name', $user->first_name, ['class' => 'uk-input uk-form-width-large', 'id'=>'first_name']) }}
                    </div>
                    <div class="uk-margin">
                        {{ Form::label('last_name', 'Last name:', ['class' => 'uk-form-label']) }}
                        {{ Form::text('last_name', $user->last_name, ['class' => 'uk-input uk-form-width-large', 'id'=>'last_name']) }}
                    </div>

                </div>
                <div class="single-div" style="transform: translate(150%, -31.5em);">
                    {{--                    BLOCK JOB DESCRIPTION--}}
                    <h2 class="header-bg">Description:  <button class="uk-button-primary" style="font-size: 1.5rem; height: 1.75em; float: right;" onclick="triggerchangeDesc()">Edit</button></h2>
                    <div class="uk-margin">
                        {{ Form::label('description', 'Description:', ['class' => 'uk-form-label']) }}
                        {{ Form::email('description', $user->description, ['class' => 'uk-input uk-form-width-large', 'id'=>'desc']) }}
                    </div>
                </div>
            </div>

            <!--SAVE-BUTTON-->
{{--            <div class="save_button_area">--}}
{{--                <div class="save_button">--}}
{{--                    {{ Form::submit('Save', ['class' => 'uk-button uk-button-default']) }}--}}
{{--                </div>--}}
{{--                <div class="flash-message">--}}
{{--                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)--}}
{{--                        @if(Session::has('alert-' . $msg))--}}
{{--                            <p class="alert uk-alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </div> <!-- end .flash-message -->--}}
{{--            </div>--}}
            <!--DELETE-BUTTON-->
{{--            <a class="uk-button uk-button-danger" onclick="return confirm('Are you sure? This can not be undone')"--}}
{{--               href="{{ route('client.delete', ['id' => $client->id]) }}">Delete user--}}
{{--            </a>--}}

        </fieldset>
{{--        {{ Form::close() }}--}}
    </div>
    <div style="display: none">
{{--    <div>--}}

        <form id="changeContact" enctype="multipart/form-data" action="{{ route('user.updateContact', $user->id) }}" method="POST">
            @csrf
            <input id="phoneSend" type="text" name="phone">
            <input id="emailSend" type="text" name="email">
            <input id="changeContactBtn" type="submit" class="pull-right btn btn-sm btn-primary">
        </form>
        <form id="changeName" enctype="multipart/form-data" action="{{ route('user.updateName', $user->id) }}" method="POST">
            @csrf
            <input id="firstSend" type="text" name="first">
            <input id="lastSend" type="text" name="last">
            <input id="changeNameBtn" type="submit" class="pull-right btn btn-sm btn-primary">
        </form>
        <form id="changeDesc" enctype="multipart/form-data" action="{{ route('user.updateDesc', $user->id) }}" method="POST">
            @csrf
            <input id="descSend" type="text" name="desc">
            <input id="changeDescBtn" type="submit" class="pull-right btn btn-sm btn-primary">
        </form>
    </div>


    <script>
        function showPicUpload(){
            let elem = document.getElementById("uploadPicForm");
            elem.style.display="inline-block";
        }

        function triggerchangeContact(){
            let elem = document.getElementById("phone")
            let elemSend = document.getElementById("phoneSend");
            elemSend.value = elem.value;

            elem = document.getElementById("email")
            elemSend = document.getElementById("emailSend");
            elemSend.value = elem.value;

            elem = document.getElementById("changeContactBtn");
            elem.click();
        }

        function triggerchangeName(){
            let elem = document.getElementById("first_name")
            let elemSend = document.getElementById("firstSend");
            elemSend.value = elem.value;

            elem = document.getElementById("last_name")
            elemSend = document.getElementById("lastSend");
            elemSend.value = elem.value;

            elem = document.getElementById("changeContactBtn");
            elem.click();
        }

        function triggerchangeDesc(){
            let elem = document.getElementById("desc")
            let elemSend = document.getElementById("descSend");
            elemSend.value = elem.value;

            elem = document.getElementById("changeDescBtn");
            elem.click();
        }
    </script>
@endsection
