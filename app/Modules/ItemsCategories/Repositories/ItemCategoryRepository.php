<?php


namespace ItemsCategories\Repositories;
use ItemsCategories\Models\FirstCat;
use ItemsCategories\Models\SecondCat;
use ItemsCategories\Models\ThirdCat;

class ItemCategoryRepository implements ItemCategoryRepositoryInterface
{
    public function allFirstData()
    {
        return FirstCat::all();
    }

    public function allSecondData()
    {
        return SecondCat::all();
    }

    public function allThirdData()
    {
        return ThirdCat::all();
    }


    public function getFirstCat($id)
    {
        return FirstCat::findOrfail($id);
    }

    public function getSecondCat($id)
    {
        return SecondCat::findOrfail($id);
    }

    public function getThirdCat($id)
    {
        return ThirdCat::findOrfail($id);
    }

    public function saveFirstData($request,$id=null)
    {
        if ($id == null) {
            $item = new FirstCat();
        }
        else{
            $item = $this->getFirstCat($id);
        }
        $item->name = $request->name;
        $item->save();
    }

    public function saveSecondData($request,$id=null)
    {
        $item = new SecondCat();
        $item->name = $request->name;
        $item->first_cat = $id;
        $item->save();
    }

    public function saveThirdData($request,$id=null)
    {
        $item = new ThirdCat();
        $item->name = $request->name;
        $item->second_cat = $id;
        $item->save();
    }

    public function deleteFirstCat($id)
    {
        return FirstCat::findOrfail($id)->delete();
    }

    public function deleteSecondCat($id)
    {
        return SecondCat::findOrfail($id)->delete();
    }

    public function deleteThirdCat($id)
    {
        return ThirdCat::findOrfail($id)->delete();
    }

    public function getSecondDataByFirstCategory($id)
    {
        if (is_array($id)) {
            return SecondCat::whereIn('first_cat',$id)->get();
        }else{
            return SecondCat::where('first_cat',$id)->get();
        }
    }

    public function getThirdDataBySecondCategory($id)
    {
        return ThirdCat::where('second_cat',$id)->get();
    }


}
