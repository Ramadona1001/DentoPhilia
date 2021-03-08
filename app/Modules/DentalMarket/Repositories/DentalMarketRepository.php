<?php


namespace DentalMarket\Repositories;

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use File;
use Items\Models\Item;
use ItemsCategories\Models\FirstCat;
use ItemsCategories\Models\SecondCat;

class DentalMarketRepository implements DentalMarketRepositoryInterface
{
    public function allData()
    {
        return Item::where('species',0)->paginate(10);
    }

    public function allFirstCat()
    {
        return FirstCat::where('species',0)->where('item_for',0)->get();
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

    public function getSecondDataByFirstCategory($firstcat)
    {
        if (is_array($firstcat)) {
            return SecondCat::whereIn('first_cat',$firstcat)->get();
        }else{
            return SecondCat::where('first_cat',$firstcat)->get();
        }
    }

    public function getItemFiltered($request)
    {
        $item = Item::where('id','>',0);

        if (isset($request->items_search)) {
            $item->where('name','like','%'.$request->items_search.'%');
        }

        if (isset($request->first_category)) {
            if (count($request->first_category) > 1) {
                $item->whereIn('first_category',$request->first_category);
            }else{

                $item->where('first_category',$request->first_category[0]);
            }
        }


        if (isset($request->second_category)) {
            if (count($request->second_category) > 1) {
                $item->whereIn('second_category',$request->second_category);
            }else{
                $item->where('second_category',$request->second_category[0]);
            }
        }

        if ($request->price_from != null && $request->price_to != null) {
            $item->whereBetween('price',[$request->price_from,$request->price_to]);
        }elseif ($request->price_from != null && $request->price_to == null) {
            $item->where('price','>=',$request->price_from);
        }elseif($request->price_from == null && $request->price_to != null) {
            $item->where('price','<=',$request->price_to);
        }elseif($request->price_from == null && $request->price_to == null){
            $item->where('price','>=','0');
        }

        if (isset($request->lab_category)) {
            if ($request->lab_category == 'on') {
                $item->where('item_for',1);
            }else{
                $item->where('item_for',0);
            }
        }



        return $item->get();
    }


}
