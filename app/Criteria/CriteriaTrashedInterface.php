<?php
/**
 * File: CriteriaTrashedInterface.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 07/02/17
 * Time: 23:07
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Criteria;


interface CriteriaTrashedInterface
{
    public function onlyTrashed();

    public function withTrashed();
}