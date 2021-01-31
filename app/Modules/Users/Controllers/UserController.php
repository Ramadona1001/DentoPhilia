<?php

namespace Users\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Users\Repositories\UserRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Spatie\Permission\Models\Role;
use Users\Requests\UserRequest;
use Users\Requests\UserRequestUpdate;

class UserController extends Controller
{
    public $path;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'Users::';
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        hasPermissions('show_users');

        $title = transWord('All Users');
        $pages = [
            [transWord('All Users'),'users']
        ];
        $users = $this->userRepository->allData();
        return view($this->path.'index',compact('users','pages','title'));
    }

    public function permissions($id)
    {
        $id = Crypt::decrypt($id);
        hasPermissions('permissions_users');
        $user = $this->userRepository->getDataId($id);
        $permissionsName = $this->userRepository->getPermissions($id)[0];
        $permissions = $this->userRepository->getPermissions($id)[2];
        $assignedPermissions = $this->userRepository->getPermissions($id)[3];
        $title = transWord('All Permissions');
        $pages = [
            [transWord('Users'),'users']
        ];
        return view($this->path.'permissions',compact('permissionsName','user','permissions','assignedPermissions','pages','title'));
    }

    public function assignPermissions($id,Request $request)
    {
        $this->userRepository->assignPermissions($id,$request);
    }

    public function logout(){
        $this->userRepository->logout();
        return redirect('/login');
    }

    public function register(UserRequest $request)
    {
        $this->userRepository->saveData($request,null);
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect()->route('website');
    }

    public function create()
    {
        hasPermissions('create_users');
        $title = transWord('Create User');
        $pages = [
            [transWord('Users'),'users']
        ];
        $roles = Role::all();
        return view($this->path.'create',compact('pages','title','roles'));
    }

    public function store(UserRequest $request)
    {
        hasPermissions('create_users');
        $this->userRepository->saveData($request,null);
        return redirect()->route('users')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_users');
        $id = Crypt::decrypt($id);
        $title = transWord('Update User');
        $pages = [
            [transWord('Users'),'users']
        ];
        $user = $this->userRepository->getDataId($id);
        $roles = Role::all();
        return view($this->path.'edit',compact('pages','title','roles','user'));
    }

    public function update(UserRequestUpdate $request,$id)
    {
        hasPermissions('update_users');
        $id = Crypt::decrypt($id);
        $this->userRepository->saveData($request,$id);

        return redirect()->route('users')->with('success','');
    }

    public function delete($id)
    {
        hasPermissions('delete_users');
        $id = Crypt::decrypt($id);
        $this->userRepository->deleteData($id);
        return redirect()->route('users')->with('success','');
    }



}
