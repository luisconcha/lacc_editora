<?php

namespace LACC;

use Illuminate\Database\Eloquent\Model;

class TelephoneUser extends Model
{
    protected $table    = 'telephone_users';

    protected $fillable = [
        'num_telephone', 'type_telephone','user_id'
    ];
}
