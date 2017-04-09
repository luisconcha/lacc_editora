<?php
namespace LaccBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
      'name',
      'content',
      'order',
      'book_id',
    ];

    public function book()
    {
        return $this->belongsTo( Book::class );
    }
}
