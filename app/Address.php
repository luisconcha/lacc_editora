<?php

namespace LACC;

use Illuminate\Database\Eloquent\Model;

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
