<?php

namespace Items\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Items\Repositories\ItemRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Items\Requests\ItemRequest;
use Items\Requests\ItemRequestUpdate;

class ItemController extends Controller
{
    public $path;
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'Items::';
        $this->itemRepository = $itemRepository;
    }

    public function index()
    {
        hasPermissions('show_items');

        $title = transWord('All Items');
        $pages = [
            [transWord('All Items'),'items']
        ];
        $items = $this->itemRepository->allData();
        return view($this->path.'index',compact('items','pages','title'));
    }


    public function create()
    {
        hasPermissions('create_items');
        $title = transWord('Create Item');
        $pages = [
            [transWord('Items'),'items']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(ItemRequest $request)
    {
        hasPermissions('create_items');
        $this->itemRepository->saveData($request,null);
        return redirect()->route('items')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_items');
        $id = Crypt::decrypt($id);
        $title = transWord('Update Item');
        $pages = [
            [transWord('Items'),'items']
        ];
        $item = $this->itemRepository->getDataId($id);
        return view($this->path.'edit',compact('pages','title','item'));
    }

    public function update(ItemRequest $request,$id)
    {
        hasPermissions('update_items');
        $id = Crypt::decrypt($id);
        $this->itemRepository->saveData($request,$id);

        return redirect()->route('items')->with('success','');
    }

    public function delete($id)
    {
        hasPermissions('delete_items');
        $id = Crypt::decrypt($id);
        $this->itemRepository->deleteData($id);
        return redirect()->route('items')->with('success','');
    }

}
