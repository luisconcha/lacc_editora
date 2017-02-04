<?php
namespace LACC;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TableInterface
{
    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany( Book::class,'category_id' );
    }

    public function getTableHeaders()
    {
        return [ '#', 'Name Category' ];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Name Category':
                return $this->name;
        }
    }

}
