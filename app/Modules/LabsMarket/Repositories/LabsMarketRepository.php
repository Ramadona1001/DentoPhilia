<?php


namespace LabsMarket\Repositories;

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use File;
use Items\Models\Item;
use ItemsCategories\Models\FirstCat;
use ItemsCategories\Models\SecondCat;

class LabsMarketRepository implements LabsMarketRepositoryInterface
{
    public function allData()
    {
        return Item::where('species',1)->paginate(10);
    }

    public function allFirstCat()
    {
        return FirstCat::where('species',1)->get();
    }

    public function getDataId($id){
        return Item::findOrfail($id);
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
        $item = Item::where('id','>',0)->where('species',1);

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


        return $item->get();
    }


}
