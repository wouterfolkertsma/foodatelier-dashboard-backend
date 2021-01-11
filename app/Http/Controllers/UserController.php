<?php


namespace App\Http\Controllers;


use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
//    /**
//     * @param Request $request
//     * @return Application|Factory|View
//     */
//    public function user(Request $request)
//    {
//        return view('admin.edit-profile');
//    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function userManager(Request $request)
    {
        $users = User::all();
        return view('user.users-management',['users' => $users]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $employeeId
     * @return Application|Factory|View
     */
    public function editUser(Request $request, User $user)
    {
        return view('admin.edit-profile', [
            'user' => $user,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $employeeId
     * @return Application|Factory|View
     */
    public function editUserSettings(Request $request, User $user)
    {
        return view('admin.edit-profile-settings', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Application|Factory|View
     */
    public function updateAvatar(Request $request, User $user) {
        $user->avatar_url = Storage::putFile('storage/avatars', $request->file('avatar'));
        $user->save();

        return view('profile', ['user' => Auth::user()] );
    }

    public function updateContact(Request $request, User $user){
        $user->first_name = $user->first_name;
        $user->last_name = $user->last_name;
        $user->avatar_url = $user->avatar_url;
        $user->email = $request->input('email');
        $user->password = $user->password;
        $user->profile_type = $user->profile_type;
        $user->profile_id = $user->profile_id;
        $user->role_id = $user->role_id;
        $user->save();

        // Return to home
        return view('client.dashboard', ['user' => Auth::user()] );
    }

    public function updateName(Request $request, User $user){
        $user->first_name = $request->input('first');
        $user->last_name = $request->input('last');
        $user->avatar_url = $user->avatar_url;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->profile_type = $user->profile_type;
        $user->profile_id = $user->profile_id;
        $user->role_id = $user->role_id;
        $user->save();

        // Return to home
        return view('client.dashboard', ['user' => Auth::user()] );
    }

    public function updateDesc(Request $request, User $user){
        $user->first_name = $user->first_name;
        $user->last_name = $user->last_name;
        $user->avatar_url = $user->avatar_url;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->profile_type = $user->profile_type;
        $user->profile_id = $user->profile_id;
        $user->role_id = $user->role_id;
        $user->save();

        // Return to home
        return view('client.dashboard', ['user' => Auth::user()] );
    }


}
