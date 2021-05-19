<?php

namespace Items\Repositories;

interface ItemRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($request,$id=null);
    public function deleteData($id);
    public function approveData($id);
    public function disApproveData($id);
}
