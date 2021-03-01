<?php

namespace ItemsCategories\Controllers;

use App\Http\Controllers\Controller;
use ItemsCategories\Repositories\ItemCategoryRepository;
use Illuminate\Support\Facades\Crypt;
use ItemsCategories\Requests\ItemCategoryRequest;

class secondItemCategoryController extends Controller
{
    public $path;
    private $ItemsCategoryRepository;

    public function __construct(ItemCategoryRepository $ItemsCategoryRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'ItemsCategories::second.';
        $this->ItemsCategoryRepository = $ItemsCategoryRepository;
    }

    public function index()
    {
        hasPermissions('show_items_categories');

        $title = transWord('All Items Categories');
        $pages = [
            [transWord('All Items Categories'),'items_categories']
        ];
        $items_categories = $this->ItemsCategoryRepository->allSecondData();
        return view($this->path.'index',compact('items_categories','pages','title'));
    }


    public function create($id)
    {
        hasPermissions('create_items_categories');
        $id = Crypt::decrypt($id);
        $title = transWord('Create Item Category');
        $pages = [
            [transWord('Item Categories'),'items_categories']
        ];
        return view($this->path.'create',compact('pages','title','id'));
    }

    public function store(ItemCategoryRequest $request,$id)
    {
        hasPermissions('create_items_categories');
        $id = Crypt::decrypt($id);
        $this->ItemsCategoryRepository->saveSecondData($request,$id);
        return redirect()->route('items_categories')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_items_categories');
        $id = Crypt::decrypt($id);
        $title = transWord('Update Item Category');
        $pages = [
            [transWord('BusinessAccounts'),'items_categories']
        ];
        $items_categories = $this->ItemsCategoryRepository->getSecondCat($id);
        return view($this->path.'edit',compact('pages','title','items_categories'));
    }

    public function update(ItemCategoryRequest $request,$id)
    {
        hasPermissions('update_items_categories');
        $id = Crypt::decrypt($id);
        $this->ItemsCategoryRepository->saveSecondData($request,$id);

        return redirect()->route('items_categories')->with('success','');
    }

    public function delete($id)
    {
        hasPermissions('delete_items_categories');
        $id = Crypt::decrypt($id);
        $this->ItemsCategoryRepository->deleteSecondCat($id);
        return redirect()->route('items_categories')->with('success','');
    }

    public function dataAjax($firstcatid)
    {
        $data = $this->ItemsCategoryRepository->getSecondDataByFirstCategory($firstcatid);
        return response()->json(['data'=>$data]);
    }

}
