<div class="message-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                <div class="{{($message->from == Auth::id()) ? 'sent' : 'received'}}">
                    <p>{{$message->message}}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                </div>
            </li>
        @endforeach

    </ul>
</div>
<div class="input-text">
    <input type="text" name="message" class="submit uk-input uk-form-width-medium uk-form-large">
</div>
