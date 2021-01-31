<?php

namespace Menus\Repositories;

interface MenuRepositoryInterface
{
    public function allData();

    public function dataWithConditions($conditions);

    public function getDataId($id);

    public function saveData($request, $id = null);

    public function deleteData($id);

    public function parentMenuEdit($menu);
}
