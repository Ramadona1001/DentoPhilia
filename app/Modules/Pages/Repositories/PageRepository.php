<?php


namespace Pages\Repositories;

use Pages\Models\Page;


class PageRepository implements PageRepositoryInterface
{
    public function allData(){
        return Page::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Page::$wheres->get();
    }

    public function getDataId($id){
        return Page::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
           $page = new Page();
        }else{
            $page = Page::findOrfail($id);
        }
        $page->title = json_encode($request->title);
        $page->slug = json_encode($request->slug);
        $page->content = json_encode($request->content);
        $page->publish = $request->publish;
        $page->menu_id = $request->menu;
        if(isset($request->meta_title))
            $page->meta_title = json_encode($request->meta_title);
        if(isset($request->meta_desc))
            $page->meta_desc = json_encode($request->meta_desc);
        if(isset($request->meta_keywords))
            $page->meta_keywords = json_encode($request->meta_keywords);
        $page->save();

    }

    public function deleteData($id)
    {
        $role = Page::findOrfail($id)->delete();
//        saveLog('Delete Role '.$user->name, 'Roles');
    }
}
