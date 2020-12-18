<?php


namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\UsersMessage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use DB;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;


/**
 * @method static factory()
 */
class MessengerController extends Controller
{
    /** @var Pusher */
    private $pusher;

    public function __construct()
    {
        $options = [
            'cluster' => 'eu',
            'useTLS' => true
        ];

        $this->pusher = new Pusher(
            env( 'PUSHER_APP_KEY'),
            env( 'PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
    }

    /**
     * @return Application|Factory|View
     */
    public function messengerInbox()
    {
        $users = DB::table('users_messages')
            ->where('user_id_to', Auth::id())
            ->leftJoin('messages', function ($join) {
                $join->on('messages.id', '=', 'users_messages.message_id')
                    ->where('messages.is_read', '=', 0);
            })
            ->join('users', 'user_id_from', '=', 'users.id')
            ->select('users.id', 'users.email', 'users.first_name', 'users.last_name', DB::raw("count(messages.id) as unread"))
            ->groupBy('user_id_from')
            ->get()
        ;

        return view('messenger.inbox', [
            'users' => $users
        ]);
    }

    /**
     * @param $user_id
     * @return Application|Factory|View
     */
    public function messengerMessage(int $user_id) {

        $messages = UsersMessage::where('user_id_from', Auth::id())
            ->where('user_id_to', $user_id)
            ->orWhere('user_id_from', $user_id)
            ->where('user_id_to', Auth::id())
            ->join('messages', 'message_id', '=', 'messages.id')
            ->get();


        $messages->each(function ($message) {
            Message::whereId($message->message_id)
                ->update(['is_read' => 1]);
        });

        return view('messenger.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request) {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $message = (new Message())->fill(['message' => $message, 'is_read' => 0]);
        $message->save();

        $usersMessage = new UsersMessage();
        $usersMessage->fill([
            'user_id_from' => $from,
            'user_id_to' => $to,
            'message_id' => $message->id
        ]);

        $usersMessage->save();

        $data = [
            'from' => $from,
            'to' => $to,
        ];

        $this->pusher->trigger('my-channel', 'my-event', $data);
    }
}
