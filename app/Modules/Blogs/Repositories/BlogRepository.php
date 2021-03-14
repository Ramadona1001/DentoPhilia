<?php


namespace Blogs\Repositories;

use Blogs\Models\Blog;
use File;

class BlogRepository implements BlogRepositoryInterface
{
    public function allData(){
        return Blog::paginate(6);
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
        $blogPath = public_path().'/uploads/blogs/';
        $blogDeletePath = 'uploads\\blogs\\';
        File::makeDirectory($blogPath, $mode = 0777, true, true);

        if ($id == null) {
            $blog = new Blog();
            uploadImage($blogPath,'blog_img','blog_',$blog);
        }else{
            $blog = $this->getDataId($id);
            uploadImageAndDeleteOld($blogDeletePath,$blogPath,'blog_img','blog_',$blog);
        }
        $blog->title = $request->title;
        $blog->tags = $request->tags;
        $blog->content = $request->content;
        $blog->publish = $request->publish;
        if(isset($request->meta_title))
            $blog->meta_title = $request->meta_title;
        if(isset($request->meta_desc))
            $blog->meta_desc = $request->meta_desc;
        if(isset($request->meta_keywords))
            $blog->meta_keywords = $request->meta_keywords;
        $blog->save();
    }

    public function deleteData($id)
    {
        $blog = Blog::findOrfail($id)->delete();
    }
}
