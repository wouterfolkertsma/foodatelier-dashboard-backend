@extends('layout.base')

@section('title', 'Client Management')

@section('content')
<div class="messenger-inbox" id="messenger-inbox" data-id="{{ \Illuminate\Support\Facades\Auth::id() }}">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach($users as $user)
                        <hr>
                        <li class="user" id="{{$user->id}}">
                            @if($user->unread)
                                <span class="pending">{{$user->unread}}</span>
                            @endif

                            <div class="media">
                                <div class="media-left">
                                    <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                </div>

                                <div class="media-body">
                                    <p class="name">{{$user->first_name}} , {{$user->last_name}}</p>
                                    <p class="email">{{$user->email}}</p>
                                </div>
                            </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="col-md-8" id="messages">

        </div>

    </div>
</div>
</div>
@endsection
