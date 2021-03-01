<?php

namespace BusinessAccounts\Repositories;

interface BusinessAccountRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($request,$id=null);
    public function deleteData($id);
    public function approveData($id);
    public function disApproveData($id);
    public function getBusinessAccountDataByUser($user_id);
    public function getBusinessAcountsItems($user_id);
}
