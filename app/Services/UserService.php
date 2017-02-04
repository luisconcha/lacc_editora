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
        $categories = [ '' => '--select an category--' ];
        $categories += $this->usermodel->orderby( 'name', 'asc' )->pluck( 'name','id' )->all();

        return $categories;
    }
}