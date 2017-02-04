<?php

namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table    = 'state';
    protected $fillable = [
        'nom_state', 'sig_state'
    ];
}
