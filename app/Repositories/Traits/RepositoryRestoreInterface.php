<?php
/**
 * File: RepositoryRestoreInterface.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 07/02/17
 * Time: 23:36
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Repositories\Traits;


interface RepositoryRestoreInterface
{
   public function restore( $id );
}