<?php

namespace Items\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function firstCat()
    {
        return $this->belongsTo('ItemsCategories\Models\FirstCat', 'first_category');
    }

    public function secondCat()
    {
        return $this->belongsTo('ItemsCategories\Models\SecondCat', 'second_category');
    }

    public function thirdCat()
    {
        return $this->belongsTo('ItemsCategories\Models\ThirdCat', 'third_category');
    }
}
