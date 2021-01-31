<?php

namespace Menus\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    public function getParent($parent)
    {
        if($parent != 0){
            $parentName = Menu::findOrfail($parent);
            return getDataFromJsonByLanguage($parentName->title);
        }
        else
            return transWord('Root');
    }
}
