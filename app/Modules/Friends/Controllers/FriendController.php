<?php

namespace Friends\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Friends\Repositories\FriendRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Friends\Requests\FriendRequest;
use Friends\Requests\FriendRequestUpdate;

class FriendController extends Controller
{
    public $path;
    private $friendRepository;

    public function __construct(FriendRepository $friendRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'Friends::';
        $this->friendRepository = $friendRepository;
    }

    public function index($user)
    {
        hasPermissions('show_friends');

        $title = transWord('All Friends');
        $pages = [
            [transWord('All Friends'),'friends']
        ];
        $friends = $this->friendRepository->getAllFriends($user);
        return view($this->path.'index',compact('friends','pages','title'));
    }


    public function add($user)
    {
        hasPermissions('add_friends');
        $user = Crypt::decrypt($user);
        $this->friendRepository->sendFriend($user);
        return response()->json(
            ['success'=>$user]
        );
    }

    public function me($username)
    {
        hasPermissions('show_friends');
        $title = transWord('All Friends');
        $pages = [
            [transWord('All Friends'),'friends']
        ];
        $friends = $this->friendRepository->myFriends($username);
        return view('Users::friends',compact('friends','pages','title'));
    }


    public function delete($user)
    {
        hasPermissions('delete_friends');
        $user = Crypt::decrypt($user);
        $this->friendRepository->deleteFriend($user);
        return response()->json(
            ['success'=>$user]
        );
    }


}
