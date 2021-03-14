<?php

namespace LabsMarket\Repositories;

interface LabsMarketRepositoryInterface
{
    public function allData();
    public function allFirstCat();
    public function getDataId($id);
    public function getSecondDataByFirstCategory($firstcat);
    public function getItemFiltered($request);
}
