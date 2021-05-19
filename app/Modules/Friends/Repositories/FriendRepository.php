<?php


namespace Friends\Repositories;

use App\User;
use Cases\Models\Cases;
use Friends\Models\Friend;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Hash;

class FriendRepository implements FriendRepositoryInterface
{
    public function allData()
    {
        return Friend::paginate(10);
    }

    public function getAllFriends($user)
    {
        return Friend::where('from_user',$user)->get();
    }

    public function getDataId($id){
        return Friend::findOrfail($id);
    }

    public function myFriends($username)
    {
        $user = User::where('username',$username)->get()->first();
        return Friend::where('from_user',$user->id)->get();
    }

    public function sendFriend($touser)
    {
        $firend = new Friend();
        $firend->from_user = \Auth::user()->id;
        $firend->to_user = $touser;
        $firend->status = 1;
        $firend->save();
    }

    public function deleteFriend($touser)
    {
        $firend = Friend::where('from_user',\Auth::user()->id)->where('to_user',$touser)->delete();
    }

}
