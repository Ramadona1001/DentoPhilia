<?php

namespace Doctors\Repositories;

interface DoctorRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($request,$id=null);
    public function deleteData($id);
    public function getDoctorDataByUser($user_id);
    public function getDoctorCase($id);
    public function getDoctorCaseTypes($id);
}
