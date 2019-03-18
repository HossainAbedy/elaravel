<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyCustomer extends Model
{
    protected $guarded = [];
 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_customer_id');
    }
}
