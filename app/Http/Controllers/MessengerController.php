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

    /**
     * @return Application|Factory|View
     */
    public function messengerInbox()
    {
        //$users = User::all();
        $users = DB::select(
            "SELECT u2.id,
                   u2.first_name,
                   u2.last_name,
                   u2.email,
                   count(m.id) AS unread
            FROM users_messages um
            INNER JOIN users u ON u.id = um.user_id_from
            INNER JOIN users u2 ON u2.id = um.user_id_to
            INNER JOIN messages m ON um.message_id = m.id
            AND m.is_read = 0
            WHERE u.id = ". Auth::id() ."
            GROUP BY u2.id");

        return view('messenger.inbox', [
            'users' => $users
        ]);
    }

    public function messengerMessage($user_id) {
        $my_id = Auth::id();

        //Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
        DB::table( "SELECT u2.id,
                   u2.first_name,
                   u2.last_name,
                   u2.email,
                   count(m.id) AS unread
            FROM users_messages um
            INNER JOIN users u ON u.id = um.user_id_from
            INNER JOIN users u2 ON u2.id = um.user_id_to
            INNER JOIN messages m ON um.message_id = m.id
            AND m.is_read = 0
            WHERE (u.id = ". Auth::id() ." AND u2.id = $user_id)
            UPDATE m.is_read = 1");


        $messages = DB::select("SELECT u2.id,
                   m.message,
                   m.created_at,
                   user_id_from,
                   user_id_to
            FROM users_messages um
            INNER JOIN users u ON u.id = um.user_id_from
            INNER JOIN users u2 ON u2.id = um.user_id_to
            INNER JOIN messages m ON um.message_id = m.id
            WHERE (u.id = ". Auth::id() ." AND    u2.id = $user_id)
            OR ( u.id = $user_id AND    u2.id = ". Auth::id() .")
           ");

        //$messages = Message::where(function($query) use ($user_id, $my_id){
            //$query->where('from', $my_id)->where('to', $user_id);
        //})->orWhere(function($query) use($user_id, $my_id){
            //$query->where('from', $user_id)->where('to', $my_id);
        //})->get();

        return view('messenger.index', ['messages' =>$messages]);
    }

    public function sendMessage(Request $request) {
        $from = Auth::id();
        $to = $request->user_id_to;
        $message = $request->message;

        $data = new Message();
        $data->message = $message;
        $data->is_read = 0;
        $data->save();
        $relationData = new UsersMessage();
        $relationData->user_id_from = $from;
        $relationData->user_id_to = $to;
        $relationData->message_id = $data->id;
        $relationData->save();
        //-----PUSHER SETTINGS-------
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env( 'PUSHER_APP_KEY'),
            env( 'PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
