<?php
/**
 * File: RepositoryRestoreTrait.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 07/02/17
 * Time: 23:37
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Repositories\Traits;


trait RepositoryRestoreTrait
{
    public function restore( $id )
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $model->restore(); //Metodo restore() é habilitado após utilizar o SoftDeletes na model
    }
}