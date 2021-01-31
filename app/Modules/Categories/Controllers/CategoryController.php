<?php

namespace Categories\Controllers;

use App\Http\Controllers\Controller;
use Categories\Requests\CategoryRequest;
use Categories\Repositories\CategoryRepository;
use Courses\Repositories\CourseRepository;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    public $path;
    private $categoryRepository;
    private $courseRepository;

    public function __construct(CategoryRepository $categoryRepository , CourseRepository $courseRepository)
    {
        $this->middleware('auth');
        $this->path = 'Categories::';
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        hasPermissions('show_categories');
        $title = transWord('Categories');
        $pages = [
            [transWord('Categories'),'categories']
        ];
        $categories = $this->categoryRepository->allData();
        return view($this->path.'index',compact('categories','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_categories');
        $title = transWord('Create Categories');
        $pages = [
            [transWord('All Categories'),'categories'],
            [transWord('Create Category'),'create_categories']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(CategoryRequest $request)
    {
        hasPermissions('create_categories');
        $this->categoryRepository->saveData($request,null);
        return redirect()->route('categories')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_categories');
        $id = Crypt::decrypt($id);
        $categories = $this->categoryRepository->getDataId($id);

        $title = transWord('Show Category Data');
        $pages = [
            [transWord('Categories'),'categories'],
        ];
        $courses = $this->courseRepository->getDataIdCon('category_id',$id);
        return view($this->path.'.show',compact('categories','title','pages','courses'));
    }

    public function edit($id)
    {
        hasPermissions('update_categories');
        $id = Crypt::decrypt($id);
        $categories = $this->categoryRepository->getDataId($id);

        $title = transWord('Edit Category Data');
        $pages = [
            [transWord('Categories'),'categories'],
        ];
        return view($this->path.'.edit',compact('categories','title','pages'));
    }

    public function update(CategoryRequest $request,$id)
    {
        hasPermissions('update_categories');
        $id = Crypt::decrypt($id);
        $this->categoryRepository->saveData($request,$id);
        return redirect()->route('categories')->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_categories');
        $id = Crypt::decrypt($id);
        $this->categoryRepository->deleteData($id);
        return back()->with('success','');
    }
}
