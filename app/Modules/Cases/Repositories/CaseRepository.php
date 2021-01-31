<?php


namespace Cases\Repositories;

use App\User;
use Cases\Models\Cases;
use Doctors\Models\Doctor;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Hash;
use File;
use Crypt;

class CaseRepository implements CaseRepositoryInterface
{
    public function getDataId($id){
        return Cases::findOrfail($id);
    }

    public function getDoctorDataByUser($user_id)
    {
        return Doctor::where('user_id',$user_id)->get()->first();
    }

    public function getDoctorCases($user,$type)
    {
        return Cases::where('type',$type)->where('user_id',$user)->paginate(9);
    }

    public function saveDoctorCases($request,$id=null,$type)
    {
        $casesPath = public_path().'/uploads/cases/'.$type.'/';
        $caseDeletePath = 'uploads\\cases\\'.$type.'\\';
        File::makeDirectory($casesPath, $mode = 0777, true, true);

        if ($id == null) {
            $case = new Cases();
            uploadImage($casesPath,'preoperative_image','preoperative_',$case);
            uploadImage($casesPath,'processingoperative_image','processingoperative_',$case);
            uploadImage($casesPath,'postoperative_image','postoperative_',$case);


        }else{
            $case = $this->getDataId($id);
            uploadImageAndDeleteOld($caseDeletePath,$casesPath,'preoperative_image','preoperative_',$case);
            uploadImageAndDeleteOld($caseDeletePath,$casesPath,'processingoperative_image','preoperative_',$case);
            uploadImageAndDeleteOld($caseDeletePath,$casesPath,'postoperative_image','preoperative_',$case);
        }

        $case->type = $type;
        $case->preoperative_title = $request->preoperative_title;
        $case->processingoperative_title = $request->processingoperative_title;
        $case->postoperative_title = $request->postoperative_title;
        $case->user_id = \Auth::user()->id;
        $case->save();

    }

    public function deleteDoctorCases($id,$type)
    {
        $case = $this->getDataId($id);
        $preimage = public_path('uploads\\cases\\'.$type.'\\'.$case->preoperative_image);
        $processimage = public_path('uploads\\cases\\'.$type.'\\'.$case->processingoperative_image);
        $postimage = public_path('uploads\\cases\\'.$type.'\\'.$case->postoperative_image);
        if (\File::exists($preimage)) {
            \File::delete($preimage);
        }
        if (\File::exists($processimage)) {
            \File::delete($processimage);
        }
        if (\File::exists($postimage)) {
            \File::delete($postimage);
        }
        $case->delete();
    }
}
