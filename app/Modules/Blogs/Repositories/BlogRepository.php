<?php


namespace Blogs\Repositories;

use Blogs\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{
    public function allData(){
        return Blog::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Blog::$wheres->get();
    }

    public function getDataId($id){
        return Blog::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            $blog = new Blog();
        }else{
            $blog = $this->getDataId($id);
        }
        $blog->title = json_encode($request->title);
        $blog->tags = json_encode($request->tags);
        $blog->content = json_encode($request->content);
        $blog->publish = $request->publish;
        if(isset($request->meta_title))
            $blog->meta_title = json_encode($request->meta_title);
        if(isset($request->meta_desc))
            $blog->meta_desc = json_encode($request->meta_desc);
        if(isset($request->meta_keywords))
            $blog->meta_keywords = json_encode($request->meta_keywords);
        $blog->save();
    }

    public function deleteData($id)
    {
        $blog = Blog::findOrfail($id)->delete();
    }
}
