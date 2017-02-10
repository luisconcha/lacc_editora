<?php
namespace LACC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected  $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->belongsToMany( Book::class );
    }

    public function getNameTrashedAttribute()
    {
        return $this->trashed() ? "{$this->name} (Inactive)" : $this->name;
    }
}
