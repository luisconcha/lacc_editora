<?php

namespace LACC\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use LACC\Models\Address;
use LaccBook\Models\Book;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','num_cpf','num_rg', 'password','avatar','civil_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //Civil Status
    const CASADO     = 'Casado'; // id = 1
    const VIUVO      = 'Viúvo'; // id = 2
    const DIVORCIADO = 'Divorciado'; // id = 3
    const SOLTEIRO   = 'Solteiro'; // id = 4
    const UNKNOWN    = 'Unknown';  // id = 5

    //Type Address
    const CASA         = 'Casa'; // id = 1
    const APARTAMENTO  = 'Apartamento'; // id = 2
    const SOBRADO      = 'Sobrado'; // id = 3
    const CHACARA      = 'Chacara'; // id = 4
    const LOFT         = 'Loft'; // id = 5

    public function books()
    {
        return $this->hasMany( Book::class,'author_id' );
    }

    public function address()
    {
        return $this->hasOne( Address::class, 'user_id' );
    }
}
