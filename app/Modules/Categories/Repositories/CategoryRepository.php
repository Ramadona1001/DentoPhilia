<?php


namespace Categories\Repositories;

use Categories\Models\Category;
use File;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allData(){
        return Category::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Category::$wheres->get();
    }

    public function getDataId($id){
        return Category::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            $category = new Category();
        }else{
            $category = $this->getDataId($id);
        }
        $category->title = json_encode($request->title);
        $category->slug = json_encode($request->slug);
        $category->content = json_encode($request->content);

        $pathImage = public_path().'/uploads/backend/categories/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            $request->image->move($pathImage, $imageName);
            $category->image = $imageName;
        }

        $category->save();
    }

    public function deleteData($id)
    {
        $category = Category::findOrfail($id);
        $image_path = public_path($category->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $category->delete();
    }
}
