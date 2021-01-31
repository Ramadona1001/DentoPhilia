<?php


namespace Menus\Repositories;

use Menus\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function allData(){
        return Menu::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$value.'")';
        }
        $wheres = str_replace("'","",$wheres);

        dd(Menu::$wheres->get());
        return Menu::$wheres->get();
    }

    public function getDataId($id){
        return Menu::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            $menu = new Menu();
        }else{
            $menu = $this->getDataId($id);
        }

        $menu->title = json_encode($request->title);
        if (isset($request->parent)) {
            $menu->parent = $request->parent;
        }else{
            $menu->parent = 0;
        }
        $menu->save();

    }

    public function deleteData($id)
    {
        $menu = Menu::findOrfail($id)->delete();
//        saveLog('Delete Role '.$user->name, 'Roles');
    }

    public function parentMenuEdit($menu)
    {
        $parents = Menu::where('id','!=',$menu->id)->get();
        return $parents;
    }

}
