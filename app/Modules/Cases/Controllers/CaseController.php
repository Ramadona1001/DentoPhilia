<?php

namespace Cases\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Cases\Repositories\CaseRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Cases\Requests\CaseRequest;
use Cases\Requests\CaseRequestUpdate;

class CaseController extends Controller
{
    public $path;
    private $caseRepository;

    public function __construct(CaseRepository $caseRepository)
    {
        $this->middleware('auth');
        $this->path = 'Cases::';
        $this->caseRepository = $caseRepository;
    }

    public function allDoctorCases($type)
    {
        if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin')) {
            getCasesAndPermissions($type,'show');
            $title = transWord(strtoupper($type)).' '.transWord('Cases').' '.transWord('Dr.').Auth::user()->name;
            $cases = $this->caseRepository->getDoctorCases(Auth::user()->id,$type);
            return view($this->path.'doctors.index',compact('cases','title','type'));
        }else{
            abort(403);
        }
    }

    public function createDoctorCases($type)
    {
        if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin')) {
            getCasesAndPermissions($type,'create');
            $user = Auth::user();
            $doctor = $this->caseRepository->getDoctorDataByUser($user->id);
            $cases = $this->caseRepository->getDoctorCases($user->id,$type);
            $title = transWord('Create').' '.transWord(strtoupper($type)).' '.transWord('Case');
            return view($this->path.'doctors.create',compact('doctor','cases','title','type'));
        }else{
            abort(403);
        }
    }

    public function storeDoctorCases(CaseRequest $request,$type)
    {
        if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin')) {
            getCasesAndPermissions($type,'create');
            $this->caseRepository->saveDoctorCases($request,null,$type);
            return redirect()->route('all_doctor_cases',['type'=>$type])->with('success','');
        }
        else{
            abort(403);
        }
    }

    public function editDoctorCases($id,$type)
    {
        if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin')) {
            getCasesAndPermissions($type,'update');
            $id = Crypt::decrypt($id);
            $user = Auth::user();
            $doctor = $this->caseRepository->getDoctorDataByUser($user->id);
            $cases = $this->caseRepository->getDataId($id);
            $title = transWord('Update').' '.transWord(strtoupper($type)).' '.transWord('Case');
            return view($this->path.'doctors.edit',compact('doctor','cases','title','type'));
        }else{
            abort(403);
        }
    }

    public function updateDoctorCases(CaseRequestUpdate $request,$id,$type)
    {
        if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin')) {
            getCasesAndPermissions($type,'update');
            $id = Crypt::decrypt($id);
            $this->caseRepository->saveDoctorCases($request,$id,$type);
            return redirect()->route('all_doctor_cases',['type'=>$type])->with('success','');
        }
        else{
            abort(403);
        }
    }

    public function deleteDoctorCases($id,$type)
    {
        if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin')) {
            getCasesAndPermissions($type,'delete');
            $id = Crypt::decrypt($id);
            $this->caseRepository->deleteDoctorCases($id,$type);
            return redirect()->route('all_doctor_cases',['type'=>$type])->with('success','');
        }
        else{
            abort(403);
        }
    }



}
