<?php


namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use http\Exception;
use Pusher\Pusher;

use Illuminate\Support\Facades\Auth;
use Pusher\PusherException;


/**
 * @method static factory()
 */
class MessengerController extends Controller
{

    public function messengerInbox()
    {
        //EmployeeVersion (Can see All!)
        //$users = User::all();

        $users = DB::select("select users.id, users.first_name, users.last_name, users.email, count(is_read) as unread
        from users LEFT JOIN messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id(). "
        where users.id != " . Auth::id() . "
        group by users.id, users.first_name, users.last_name, users.email ");

        return view('messenger.inbox', [
            'users' => $users
        ]);
    }

    public function messengerMessage($user_id){
        $my_id = Auth::id();

        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        $messages = Message::where(function($query) use ($user_id, $my_id){
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function($query) use($user_id, $my_id){
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('messenger.index', ['messages' =>$messages])->with('success', 'NEW MESSAGE');;
    }

    public function sendMessage(Request $request){
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();
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
