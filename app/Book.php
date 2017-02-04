<?php

namespace LACC;

use Illuminate\Database\Eloquent\Model;
use LACC\Models\Category;

class Book extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'price' ,'author_id','category_id'
    ];

    public function author()
    {
        return $this->belongsTo( User::class );
    }

    public function category()
    {
        return $this->belongsTo( Category::class );
    }
}
