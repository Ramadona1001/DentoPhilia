<?php

namespace BusinessAccounts\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use BusinessAccounts\Repositories\BusinessAccountRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Hash;
use Auth;
use BusinessAccounts\Requests\BusinessAccountRequest;
use BusinessAccounts\Requests\BusinessAccountRequestUpdate;

class BusinessAccountController extends Controller
{
    public $path;
    private $businessAccountRepository;

    public function __construct(BusinessAccountRepository $businessAccountRepository)
    {
        $this->middleware('auth')->except([
            'register'
        ]);
        $this->path = 'BusinessAccounts::';
        $this->businessAccountRepository = $businessAccountRepository;
    }

    public function index()
    {
        hasPermissions('show_business_accounts');

        $title = transWord('All Business Accounts');
        $pages = [
            [transWord('All Business Accounts'),'business_accounts']
        ];
        $business_accounts = $this->businessAccountRepository->allData();
        return view($this->path.'index',compact('business_accounts','pages','title'));
    }


    public function create()
    {
        hasPermissions('create_business_accounts');
        $title = transWord('Create BusinessAccount');
        $pages = [
            [transWord('BusinessAccounts'),'business_accounts']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(BusinessAccountRequest $request)
    {
        hasPermissions('create_business_accounts');
        $this->businessAccountRepository->saveData($request,null);
        return redirect()->route('business_accounts')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_business_accounts');
        $id = Crypt::decrypt($id);
        $title = transWord('Show BusinessAccount');
        $pages = [
            [transWord('BusinessAccounts'),'business_accounts']
        ];
        $business_account = $this->businessAccountRepository->getDataId($id);
        return view($this->path.'show',compact('pages','title','business_account'));
    }

    public function edit($id)
    {
        hasPermissions('update_business_accounts');
        $id = Crypt::decrypt($id);
        $title = transWord('Update BusinessAccount');
        $pages = [
            [transWord('BusinessAccounts'),'business_accounts']
        ];
        $business_account = $this->businessAccountRepository->getDataId($id);
        return view($this->path.'edit',compact('pages','title','business_account'));
    }

    public function update(BusinessAccountRequestUpdate $request,$id)
    {
        hasPermissions('update_business_accounts');
        $id = Crypt::decrypt($id);
        $this->businessAccountRepository->saveData($request,$id);

        return redirect()->route('business_accounts')->with('success','');
    }

    public function delete($id)
    {
        hasPermissions('delete_business_accounts');
        $id = Crypt::decrypt($id);
        $this->businessAccountRepository->deleteData($id);
        return redirect()->route('business_accounts')->with('success','');
    }

    public function approve($id)
    {
        hasPermissions('approve_business_accounts');
        $id = Crypt::decrypt($id);
        $this->businessAccountRepository->approveData($id);
        return redirect()->route('business_accounts')->with('success','');
    }

    public function disapprove($id)
    {
        hasPermissions('approve_business_accounts');
        $id = Crypt::decrypt($id);
        $this->businessAccountRepository->disApproveData($id);
        return redirect()->route('business_accounts')->with('success','');
    }

    public function completeProfile()
    {
        $user = Auth::user();
        $title = transWord('Complete Your Profile');
        $business_account = $this->businessAccountRepository->getBusinessAccountDataByUser($user->id);
        return view($this->path.'complete-profile',compact('business_account','title'));
    }

    public function completeProfilePost(Request $request)
    {
        $user = Auth::user();
        $business_account = $this->businessAccountRepository->getBusinessAccountDataByUser($user->id);
        $this->businessAccountRepository->saveData($request,$business_account->id);
        return redirect()->route('website');
    }

    public function profile()
    {
        $title = transWord('My Profile');
        $user = Auth::user();
        $business_account = $this->businessAccountRepository->getBusinessAccountDataByUser($user->id);
        return view($this->path.'profile.profile',compact('business_account','title'));
    }

    public function items()
    {
        $title = transWord('My Items');
        $user = Auth::user();
        $business_account = $this->businessAccountRepository->getBusinessAccountDataByUser($user->id);
        $items = $this->businessAccountRepository->getBusinessAcountsItems($user->id);
        return view($this->path.'profile.items',compact('business_account','items','title'));
    }


}
