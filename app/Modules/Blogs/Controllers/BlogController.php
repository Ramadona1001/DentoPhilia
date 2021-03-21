<?php

namespace Blogs\Controllers;

use App\Http\Controllers\Controller;
use Blogs\Repositories\BlogRepository;
use Blogs\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public $path;
    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->middleware('auth');
        $this->path = 'Blogs::';
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        hasPermissions('show_blogs');
        $title = transWord('Blogs');
        $pages = [
            [transWord('Blogs'),'blogs']
        ];
        $blogs = $this->blogRepository->allData();
        return view($this->path.'index',compact('blogs','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_blogs');
        $title = transWord('Create Blogs');
        $pages = [
            [transWord('All Blogs'),'blogs'],
            [transWord('Create Blogs'),'create_blogs']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(BlogRequest $request)
    {
        hasPermissions('create_blogs');
        $this->blogRepository->saveData($request,null);
        return redirect()->route('blogs')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_blogs');
        $id = Crypt::decrypt($id);
        $blog = $this->blogRepository->getDataId($id);

        $title = transWord('Edit Blog Data');
        $pages = [
            [transWord('Roles'),'roles'],
//            [$blog->name,['show_roles',Crypt::encrypt($role->id)]]
        ];
        return view($this->path.'.edit',compact('blog','title','pages'));
    }

    public function update(BlogRequest $request,$id)
    {
        hasPermissions('update_blogs');
        $id = Crypt::decrypt($id);
        $this->blogRepository->saveData($request,$id);
        return redirect()->route('blogs')->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_blogs');
        $id = Crypt::decrypt($id);
        $this->blogRepository->deleteData($id);
        return back()->with('success','');
    }

    public function singleBlog($slug)
    {
        $blog = $this->blogRepository->getDataSlug($slug);
        $replies = $this->blogRepository->getReplies($blog->id);
        $title = $blog->title;
        $pages = [
            [transWord('All Blogs'),'blogs'],
            [transWord('Create Blogs'),'create_blogs']
        ];
        return view($this->path.'single',compact('pages','title','blog','replies'));
    }

    public function reply($id,Request $request)
    {
        $this->blogRepository->replyBlog($id,$request);
        return back();
    }
}
