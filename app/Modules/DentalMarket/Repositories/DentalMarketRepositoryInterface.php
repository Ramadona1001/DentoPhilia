<?php

namespace DentalMarket\Repositories;

interface DentalMarketRepositoryInterface
{
    public function allData();
    public function allFirstCat();
    public function getDataId($id);
    public function saveData($request,$id=null);
    public function deleteData($id);
    public function getSecondDataByFirstCategory($firstcat);
    public function getItemFiltered($request);
}
