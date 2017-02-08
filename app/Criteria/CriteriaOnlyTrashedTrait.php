<?php
/**
 * File: CriteriaOnlyTrashedTrait.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 07/02/17
 * Time: 23:06
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Criteria;

trait CriteriaOnlyTrashedTrait
{
    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }
}