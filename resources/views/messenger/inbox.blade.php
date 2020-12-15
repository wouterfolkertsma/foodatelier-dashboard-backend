@extends('layout.base')

@section('title', 'Client Management')

@section('content')
<div class = messenger-inbox>
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

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Just for Develop:
        //Pusher.logToConsole = true;

        var pusher = new Pusher('870703b0ea4e1f8cea6b', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if(my_id == data.from){ //Sender
                $('#' + data.to).click();//Refresh
            } else if (my_id == data.to){ //Receiver
                newMessageRecieved();
                if(receiver_id == data.from){
                    $('#' + data.from).click();//Refresh
                }else{
                    var pending = parseInt($('#' + data.from).find('.pending').html());
                    if(pending){
                        $('#' + data.from).find('.pending').html(pending + 1)
                    }else{
                        $('#' + data.from).append('<span class="pending">1</span>')
                    }
                }
            }
        });

        $('.user').click(function (){
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id =$(this).attr('id');
            $.ajax({
                type:"get",
                url: "messenger/" + receiver_id,
                data:"",
                cache:false,
                success: function (data){
                    $('#messages').html(data);
                    scrollToBottom();
                }

            });
        });

        $(document).on('keyup', '.input-text input', function(e){
            var message = $(this).val();

            if(e.keyCode == 13 && message != '' && receiver_id !=''){
                $(this).val('');

                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type:"post",
                    url:"message",
                    data: datastr,
                    cache: false,
                    success: function (data){

                        console.log("Message - > Send")
                        $('#' + data.from).click();
                        scrollToBottom();
                    },
                    error: function (jqXHR, status, err){

                    },
                    complete:function (){

                    }
                })
            }
        });
    });

    function scrollToBottom(){
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }

    function newMessageRecieved(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'info',
            title: "received new message!"
        })
    }
</script>
@endsection
