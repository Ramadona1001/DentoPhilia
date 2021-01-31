<?php

namespace Pages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Menus\Repositories\MenuRepository;
use Pages\Repositories\PageRepository;
use Pages\Requests\PageRequest;


class PageController extends Controller
{
    public $path;
    private $pageRepository;
    private $menuRepository;

    public function __construct(PageRepository $pageRepository , MenuRepository $menuRepository)
    {
        $this->middleware('auth');
        $this->path = 'Pages::';
        $this->pageRepository = $pageRepository;
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        hasPermissions('show_pages');

        $title = transWord('Pages');
        $pages = [
            [transWord('Pages'),'pages']
        ];
        $allpages = $this->pageRepository->allData();
        return view($this->path.'index',compact('allpages','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_pages');

        $title = transWord('Create New Page');
        $pages = [
            [transWord('Pages'),'pages'],
            [transWord('Create Page'),'create_pages']
        ];
        $menus = $this->menuRepository->allData();
        return view($this->path.'create',compact('pages','title','menus'));
    }

    public function store(PageRequest $request)
    {
        hasPermissions('create_pages');
        $this->pageRepository->saveData($request,null);
        return redirect()->route('pages')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_pages');
        $id = Crypt::decrypt($id);
        $title = transWord('Show Page Data');
        $pagedata = $this->pageRepository->getDataId($id);
        $pages = [
            [transWord('Pages'),'pages'],
            [getDataFromJsonByLanguage($pagedata->title),'']
        ];
        return view($this->path.'show',compact('pagedata','pages','title'));
    }

    public function edit($id)
    {
        hasPermissions('update_pages');
        $id = Crypt::decrypt($id);
        $title = transWord('Edit Page Data');
        $pagedata = $this->pageRepository->getDataId($id);
        $pages = [
            [transWord('Pages'),'pages'],
            [getDataFromJsonByLanguage($pagedata->title),['show_pages',$pagedata->id]]
        ];
        $menus = $this->menuRepository->allData();
        return view($this->path.'edit',compact('pagedata','pages','title','menus'));
    }

    public function update($id,PageRequest $request)
    {
        hasPermissions('update_pages');
        $id = Crypt::decrypt($id);
        $this->pageRepository->saveData($request,$id);
        return redirect()->route('pages')->with('success','');
    }

    public function destroy($id)
    {
        hasPermissions('delete_pages');
        $id = Crypt::decrypt($id);
        $this->pageRepository->deleteData($id);
        return redirect()->route('pages')->with('success','');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
