<?php

namespace Users\Repositories;

interface UserRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function getPermissions($id);
    public function assignPermissions($id,$request);
    public function logout();
    public function saveData($request,$id=null);
    public function deleteData($id);
}
