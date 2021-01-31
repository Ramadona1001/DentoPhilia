<?php

namespace Doctors\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Doctors\Repositories\DoctorRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Doctors\Requests\DoctorRequest;
use Doctors\Requests\DoctorRequestUpdate;

class DoctorController extends Controller
{
    public $path;
    private $doctorRepository;

    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'Doctors::';
        $this->doctorRepository = $doctorRepository;
    }

    public function index()
    {
        hasPermissions('show_doctors');

        $title = transWord('All Doctors');
        $pages = [
            [transWord('All Doctors'),'doctors']
        ];
        $doctors = $this->doctorRepository->allData();
        return view($this->path.'index',compact('doctors','pages','title'));
    }


    public function create()
    {
        hasPermissions('create_doctors');
        $title = transWord('Create Doctor');
        $pages = [
            [transWord('Doctors'),'doctors']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(DoctorRequest $request)
    {
        hasPermissions('create_doctors');
        $this->doctorRepository->saveData($request,null);
        return redirect()->route('doctors')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_doctors');
        $id = Crypt::decrypt($id);
        $title = transWord('Update Doctor');
        $pages = [
            [transWord('Doctors'),'doctors']
        ];
        $doctor = $this->doctorRepository->getDataId($id);
        return view($this->path.'edit',compact('pages','title','doctor'));
    }

    public function update(DoctorRequestUpdate $request,$id)
    {
        hasPermissions('update_doctors');
        $id = Crypt::decrypt($id);
        $this->doctorRepository->saveData($request,$id);

        return redirect()->route('doctors')->with('success','');
    }

    public function delete($id)
    {
        hasPermissions('delete_doctors');
        $id = Crypt::decrypt($id);
        $this->doctorRepository->deleteData($id);
        return redirect()->route('doctors')->with('success','');
    }

    public function completeProfile()
    {
        $user = Auth::user();
        $title = transWord('Complete Your Profile');
        $doctor = $this->doctorRepository->getDoctorDataByUser($user->id);
        return view($this->path.'complete-profile',compact('doctor','title'));
    }

    public function completeProfilePost(Request $request)
    {
        $user = Auth::user();
        $doctor = $this->doctorRepository->getDoctorDataByUser($user->id);
        $this->doctorRepository->saveData($request,$doctor->id);
        return redirect()->route('website');
    }



}
