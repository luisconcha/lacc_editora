<?php

namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table    = 'city';
    protected $fillable = [
        'state_id', 'nom_state'
    ];
}
