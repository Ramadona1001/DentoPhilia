<?php

namespace Friends\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';

    public function user()
    {
        return $this->belongsTo('App\User', 'to_user');
    }
}
