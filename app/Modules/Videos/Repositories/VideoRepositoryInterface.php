<?php

namespace Videos\Repositories;

interface VideoRepositoryInterface
{
    public function allData();
    public function meVideos($id);
    public function getDataId($id);
    public function saveData($request,$id=null);
    public function deleteData($id);
}
