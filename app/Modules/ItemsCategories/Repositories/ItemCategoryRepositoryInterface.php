<?php

namespace ItemsCategories\Repositories;

interface ItemCategoryRepositoryInterface
{
    public function allFirstData();
    public function allSecondData();
    public function allThirdData();
    public function getFirstCat($id);
    public function getSecondCat($id);
    public function getThirdCat($id);
    public function saveFirstData($request,$id=null);
    public function saveSecondData($request,$id=null);
    public function saveThirdData($request,$id=null);
    public function deleteFirstCat($id);
    public function deleteSecondCat($id);
    public function deleteThirdCat($id);
    public function getSecondDataByFirstCategory($id);
    public function getThirdDataBySecondCategory($id);
}
