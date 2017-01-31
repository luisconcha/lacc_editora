<?php

namespace LACC;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'price'
    ];
}
