<?php

namespace ItemsCategories\Models;

use Illuminate\Database\Eloquent\Model;

class SecondCat extends Model
{
    protected $table = 'item_second_category';

    public function firstCat()
    {
        return $this->belongsTo('ItemsCategories\Models\FirstCat', 'first_cat');
    }
}
