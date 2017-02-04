<?php

namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;
use LACC\Models\User;

class Address extends Model
{
    protected $table    = 'address';

    protected $fillable = [
        'city_id', 'user_id', 'address' ,'district','cep','type_address'
    ];

    public function user()
    {
        return $this->hasOne( User::class );
    }

}
