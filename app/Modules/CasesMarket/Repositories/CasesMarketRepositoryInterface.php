<?php

namespace CasesMarket\Repositories;

interface CasesMarketRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function getItemFiltered($request);
}
