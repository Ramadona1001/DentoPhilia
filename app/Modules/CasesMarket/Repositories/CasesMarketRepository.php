<?php


namespace CasesMarket\Repositories;

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use Cases\Models\Cases;
use File;
use Items\Models\Item;
use ItemsCategories\Models\FirstCat;
use ItemsCategories\Models\SecondCat;

class CasesMarketRepository implements CasesMarketRepositoryInterface
{
    public function allData()
    {
        return Cases::paginate(10);
    }

    public function getDataId($id){
        return Cases::findOrfail($id);
    }

    public function getItemFiltered($request)
    {
        $item = Cases::where('id','>',0);

        if (isset($request->items_search)) {
            $item->where('preoperative_title','like','%'.$request->items_search.'%')
                 ->orWhere('processingoperative_title','like','%'.$request->items_search.'%')
                 ->orWhere('postoperative_title','like','%'.$request->items_search.'%');
        }

        if (isset($request->case_name)) {
            if (count($request->case_name) > 1) {
                $item->whereIn('type',$request->case_name);
            }else{

                $item->where('type',$request->case_name[0]);
            }
        }

        return $item->get();
    }


}
