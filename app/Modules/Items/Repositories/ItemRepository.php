<?php


namespace Items\Repositories;

use App\User;
use Items\Models\Item;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use File;

class ItemRepository implements ItemRepositoryInterface
{
    public function allData()
    {
        return Item::paginate(10);
    }

    public function getDataId($id){
        return Item::findOrfail($id);
    }

    public function saveData($request,$id=null)
    {
        $itemsPath = public_path().'/uploads/business_accounts/items/';
        $itemsDeletePath = 'uploads\\business_accounts\\items\\';

        File::makeDirectory($itemsPath, $mode = 0777, true, true);

        if ($id == null) {

            $item = new Item();

            uploadImage($itemsPath,'image','item_',$item);

        }else{
            $item = $this->getDataId($id);

            uploadImageAndDeleteOld($itemsDeletePath,$itemsPath,'image','item_',$item);
        }

        $item->name = $request->name;
        $item->price = $request->price;
        $item->desc = $request->desc;
        $item->first_category = $request->first_category;
        $item->second_category = $request->second_category;
        $item->third_category = $request->third_category;
        if ($request->item_for == null) {
            $item->item_for = 0;
        }else{
            $item->item_for = $request->item_for;
        }
        if (getBusinessAcountTypeByUser(Auth::user()->id) == 'Lab') {
            $item->species = 1;
        }
        if (getBusinessAcountTypeByUser(Auth::user()->id) == 'Shop') {
            $item->species = 0;
        }

        $item->user_id = Auth::user()->id;
        $item->save();
    }

    public function deleteData($id)
    {
        $itemsDeletePath = 'uploads\\business_accounts\\items\\';
        $item = $this->getDataId($id);
        $image_path = public_path($itemsDeletePath.$item->image);
        if (\File::exists($image_path)) {
            \File::delete($image_path);
        }
        $item->delete();
    }


}
