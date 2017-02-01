<?php

namespace LACC;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'price' ,'author_id'
    ];

    public function author()
    {
        return $this->belongsTo( User::class );
    }
}
