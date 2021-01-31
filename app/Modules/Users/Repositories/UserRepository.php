<?php


namespace Users\Repositories;

use App\User;
use Doctors\Models\Doctor;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Hash;

class UserRepository implements UserRepositoryInterface
{
    public function allData()
    {
        return User::paginate(10);
    }

    public function getDataId($id){
        return User::findOrfail($id);
    }

    public function getPermissions($id){
        $user = $this->getDataId($id);
        $permissions = Permission::all();
        $permissionsOfUser = $user->getAllPermissions();
        $assignedPermissions = [];
        foreach ($permissionsOfUser as $permssion) {
            array_push($assignedPermissions,$permssion->id);
        }
        $permissionsName = [];
        foreach ($permissions as $p) {
            if (!in_array(explode('_',$p->name)[1],$permissionsName)) {
                array_push($permissionsName,explode('_',$p->name)[1]);
            }
        }

        return [
            $permissionsName,
            $user,
            $permissions,
            $assignedPermissions
        ];

    }

    public function assignPermissions($id,$request){
        if ($request->ajax()) {
            if(isset($request->permissions)){
                $user = $this->getDataId($request->role_id);
                $user->syncPermissions();
                foreach ($request->permissions as $permission) {
                    $user->givePermissionTo(Permission::findOrfail($permission)->name);
                }
            }
            if($request->permissions == null){
                $user = User::findOrfail($request->role_id);
                $user->syncPermissions();
            }
            return response()->json('200');
        }
    }

    public function logout()
    {
        \Auth::logout();
    }

    public function saveData($request,$id=null)
    {
        if ($id == null) {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->username = $request->username;
        }else{
            $user = $this->getDataId($id);
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->removeRole($user->roles[0]->name);
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->save();

        if ($request->type == 'Doctor') {
            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->save();
        }

        if(Role::where('name',$request->type)->get()->count() == 0)
            Role::create(['name' => $request->type]);

        $user->assignRole($request->type);
    }

    public function deleteData($id)
    {
        $user = $this->getDataId($id);
        \DB::select('delete from model_has_roles where model_id = '.$id);
        $user->delete();
    }
}
