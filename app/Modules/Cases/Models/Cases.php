<?php

namespace Cases\Models;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
