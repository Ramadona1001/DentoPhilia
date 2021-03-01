<?php

namespace ItemsCategories\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdCat extends Model
{
    protected $table = 'item_third_category';

    public function secondCat()
    {
        return $this->belongsTo('ItemsCategories\Models\SecondCat', 'second_cat');
    }
}
