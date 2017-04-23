<?php
namespace LaccBook\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use FormAccessible, SoftDeletes, BookStorageTrait, BookThumbnailTrait;

    protected $fillable = [
      'title',
      'subtitle',
      'price',
      'author_id',
      'category_id',
      'dedication',
      'description',
      'website',
      'percent_complete',
      'published',
    ];

    public function author()
    {
        return $this->belongsTo( \LaccUser\Models\User::class );
    }

    public function categories()
    {
        return $this->belongsToMany( Category::class )->withTrashed();
    }

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck( 'id' )->all();
    }
}
