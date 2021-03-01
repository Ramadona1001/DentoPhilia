<?php


namespace Doctors\Repositories;

use App\User;
use Cases\Models\Cases;
use Doctors\Models\Doctor;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function allData()
    {
        return Doctor::paginate(10);
    }

    public function getDataId($id){
        return Doctor::findOrfail($id);
    }

    public function saveData($request,$id=null)
    {

        if ($id == null) {
            $doctor = new Doctor();
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->username = $request->username;
        }else{
            $doctor = $this->getDataId($id);
            $user = User::findOrfail($doctor->user_id);
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->save();

        if(Role::where('name','Doctor')->get()->count() == 0)
            Role::create(['name' => 'Doctor']);

        $user->assignRole('Doctor');

        $doctor->mobile = $request->mobile;
        $doctor->faculty = $request->faculty;
        $doctor->address = $request->address;
        $doctor->position = $request->position;
        $doctor->start_study = $request->start_date;
        $doctor->end_study = $request->end_date;
        $doctor->bio = $request->bio;
        $doctor->user_id = $user->id;
        $doctor->save();



    }

    public function deleteData($id)
    {
        $doctor = $this->getDataId($id);
        $user = User::findOrfail($doctor->user_id);
        \DB::select('delete from model_has_roles where model_id = '.$user->id);
        $user->delete();
    }

    public function getDoctorDataByUser($user_id)
    {
        return Doctor::where('user_id',$user_id)->get()->first();
    }

    public function getDoctorCase($id)
    {
        return Cases::where('user_id',$id)->get();
    }

    public function getDoctorCaseTypes($id)
    {
        $cases =  Cases::select('type')->where('user_id',$id)->get();
        $types = [];
        foreach ($cases as $case) {
            array_push($types,$case->type);
        }
        return array_unique($types);

    }
}
