<?php
/**
 * File: TelephoneUser.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 06/02/17
 * Time: 21:31
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Models;


use Illuminate\Database\Eloquent\Model;

class TelephoneUser extends Model
{
    protected $table    = 'telephone_users';
    protected $fillable = [
        'num_telephone', 'type_telephone','user_id'
    ];
}