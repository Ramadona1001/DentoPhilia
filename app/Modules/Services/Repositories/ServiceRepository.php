<?php


namespace Services\Repositories;

use Services\Models\Service;
use File;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function allData(){
        return Service::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Service::$wheres->get();
    }

    public function getDataId($id){
        return Service::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            $service = new Service();
        }else{
            $service = $this->getDataId($id);
        }
        $service->title = json_encode($request->title);
        $service->icon = $request->icon;
        $service->save();
    }

    public function deleteData($id)
    {
        Service::findOrfail($id)->delete();
    }
}
