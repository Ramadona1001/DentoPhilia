<?php

namespace Cases\Repositories;

interface CaseRepositoryInterface
{
    public function getDataId($id);
    public function getDoctorDataByUser($user_id);

    public function getDoctorCases($user,$type);
    public function saveDoctorCases($request,$id=null,$type);
    public function deleteDoctorCases($id,$type);
}
