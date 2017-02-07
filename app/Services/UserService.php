<?php
/**
 * File: UserService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 04/02/17
 * Time: 17:24
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Services;


use LACC\Models\User;

class UserService extends BaseService
{
    /**
     * @var User
     */
    protected $usermodel;

    public function __construct(User $user)
    {
        $this->usermodel = $user;
    }


    public function getListUsersInSelect()
    {
        $categories = [ '' => '--select an user--' ];
        $categories += $this->usermodel->orderby( 'name', 'asc' )->pluck( 'name','id' )->all();

        return $categories;
    }

    public function getPrepareListCivilStatus()
    {
        $arrStatus = [
            ''  => '--Select a civil status--',
            '1' => User::CASADO,
            '2' => User::VIUVO,
            '3' => User::DIVORCIADO,
            '4' => User::SOLTEIRO,
            '5' => User::UNKNOWN,
        ];
        return $arrStatus;
    }

    public function getPrepareListTypeAddress()
    {
        $arrTypeAddres = [
            ''  => '--Select an address type --',
            '1' => User::CASA,
            '2' => User::APARTAMENTO,
            '3' => User::SOBRADO,
            '4' => User::CHACARA,
            '5' => User::LOFT,

        ];

        return $arrTypeAddres;
    }

    public function setEncryptPassword( $password )
    {
        return bcrypt( trim( $password ) );
    }

    public function generateRemenberToken()
    {
        return str_random( 10 );
    }
}