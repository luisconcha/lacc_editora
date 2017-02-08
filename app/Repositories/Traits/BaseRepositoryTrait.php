<?php
/**
 * File: BaseRepositoryTrait.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/02/17
 * Time: 23:52
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Repositories\Traits;


trait BaseRepositoryTrait
{

    public function lists($column, $key = null)
    {
        $this->applyCriteria();

        return $this->model->pluck($column, $key);
    }
}