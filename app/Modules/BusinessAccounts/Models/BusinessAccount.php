<?php

namespace BusinessAccounts\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAccount extends Model
{
    protected $table = 'business_accounts';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
