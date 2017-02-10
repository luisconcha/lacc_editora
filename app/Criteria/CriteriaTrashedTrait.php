<?php
/**
 * File: CriteriaTrashedTrait.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 07/02/17
 * Time: 23:06
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Criteria;

trait CriteriaTrashedTrait
{
    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }
    public function withTrashed()
    {
        $this->pushCriteria(FindWithTrashedCriteria::class);
        return $this;
    }
}