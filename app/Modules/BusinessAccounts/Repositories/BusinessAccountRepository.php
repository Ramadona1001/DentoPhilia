<?php


namespace BusinessAccounts\Repositories;

use App\User;
use BusinessAccounts\Models\BusinessAccount;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Hash;
use File;
use Items\Models\Item;

class BusinessAccountRepository implements BusinessAccountRepositoryInterface
{
    public function allData()
    {
        return BusinessAccount::paginate(10);
    }

    public function getDataId($id){
        return BusinessAccount::findOrfail($id);
    }

    public function saveData($request,$id=null)
    {
        $commercialRecordsPath = public_path().'/uploads/business_accounts/commercial_records/';
        $commercialRecordsDeletePath = 'uploads\\business_accounts\\commercial_records\\';

        $taxCardsPath = public_path().'/uploads/business_accounts/tax_cards/';
        $taxCardsDeletePath = 'uploads\\business_accounts\\tax_cards\\';

        File::makeDirectory($commercialRecordsPath, $mode = 0777, true, true);
        File::makeDirectory($taxCardsPath, $mode = 0777, true, true);

        if ($id == null) {

            $business_account = new BusinessAccount();
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->username = $request->username;

            uploadImage($commercialRecordsPath,'commercial_record','commercial_record_',$business_account);
            uploadImage($taxCardsPath,'tax_card','tax_card_',$business_account);

        }else{
            $business_account = $this->getDataId($id);
            $user = User::findOrfail($business_account->user_id);
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            uploadImageAndDeleteOld($commercialRecordsDeletePath,$commercialRecordsPath,'commercial_record','commercial_record_',$business_account);
            uploadImageAndDeleteOld($taxCardsDeletePath,$taxCardsPath,'tax_card','tax_card_',$business_account);
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->save();

        if(Role::where('name','Business Account')->get()->count() == 0)
            Role::create(['name' => 'Business Account']);

        $user->assignRole('Business Account');

        if ($request->type != null) {
            $business_account->type = $request->type;
        }

        $business_account->mobile = $request->mobile;
        $business_account->user_id = $user->id;
        $business_account->save();



    }

    public function deleteData($id)
    {
        $business_account = $this->getDataId($id);
        $user = User::findOrfail($business_account->user_id);
        \DB::select('delete from model_has_roles where model_id = '.$user->id);
        $user->delete();
    }

    public function approveData($id)
    {
        $business_account = $this->getDataId($id);
        if ($business_account->approve == 0) $business_account->approve = 1;
        $business_account->save();
    }

    public function disApproveData($id)
    {
        $business_account = $this->getDataId($id);
        if ($business_account->approve == 1) $business_account->approve = 0;
        $business_account->save();
    }

    public function getBusinessAccountDataByUser($user_id)
    {
        return BusinessAccount::where('user_id',$user_id)->get()->first();
    }

    public function getBusinessAcountsItems($user_id)
    {
        return Item::where('user_id',$user_id)->get();
    }
}
