<?php

namespace LACC\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use FormAccessible, SoftDeletes;

    protected $fillable = [
        'title', 'subtitle', 'price' ,'author_id','category_id'
    ];

    public function author()
    {
        return $this->belongsTo( User::class );
    }

    public function categories()
    {
        return $this->belongsToMany( Category::class );
    }

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck( 'id' )->all();
    }
}
