<?php

namespace Friends\Repositories;

interface FriendRepositoryInterface
{
    public function allData();
    public function getAllFriends($user);
    public function getDataId($id);
    public function sendFriend($touser);
    public function deleteFriend($touser);
    public function myFriends($username);
}
