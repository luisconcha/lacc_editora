<?php
namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;
use LACC\Models\Book;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany( Book::class,'category_id' );
    }

}
