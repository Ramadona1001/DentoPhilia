<?php

namespace Doctors\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
