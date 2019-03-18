<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_name', 'customer_email', 'customer_password','customer_number','verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'customer_password', 'remember_token',
    // ];
    public function verifyUser(){
              return $this->hasOne('App\VerifyCustomer'); 
    }
}
