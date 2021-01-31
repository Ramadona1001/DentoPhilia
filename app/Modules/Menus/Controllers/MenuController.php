<?php

namespace Menus\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Menus\Models\Menu;
use Menus\Repositories\MenuRepository;
use Menus\Requests\MenuRequest;

class MenuController extends Controller
{
    public $path;
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->middleware('auth');
        $this->path = 'Menus::';
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        hasPermissions('show_menus');
        $title = transWord('Menus');
        $pages = [
            [transWord('Menus'),'menus']
        ];
        $menus = $this->menuRepository->allData();
        // dd($menus);
        // return json_encode($menus['data']);
       return view($this->path.'index',compact('menus','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_menus');
        $title = transWord('Create New Menu');
        $pages = [
            [transWord('Menu'),'menus'],
            [transWord('Create Menu'),'create_menus']
        ];
        $parents = $this->menuRepository->allData();
        return view($this->path.'create',compact('pages','title','parents'));
    }

    public function store(MenuRequest $request)
    {
        hasPermissions('create_menus');
        $menu = $this->menuRepository->saveData($request,null);
        return redirect()->route('menus')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_menus');
        $id = Crypt::decrypt($id);
        $menu = $this->menuRepository->getDataId($id);

        $title = transWord('Edit Menu Data');
        $pages = [
            [transWord('Menus'),'menus'],
        ];
        $parents = $this->menuRepository->parentMenuEdit($menu);
        return view($this->path.'.edit',compact('menu','title','pages','parents'));
    }

    public function update(MenuRequest $request,$id)
    {
        hasPermissions('update_menus');
        $id = Crypt::decrypt($id);
        $menu = $this->menuRepository->saveData($request,$id);
        return redirect()->route('menus')->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_menus');
        $id = Crypt::decrypt($id);
        $this->menuRepository->deleteData($id);
        return redirect()->route('menus')->with('success','');
    }

    public function ajax(MenuRequest $request) {
        if ($request->ajax()) {
            $menus = $this->menuRepository->allData();

            return response()->json(['menus'=>$menus]);
        }
    }

}
