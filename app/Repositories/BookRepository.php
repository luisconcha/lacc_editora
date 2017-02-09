<?php

namespace LACC\Repositories;

use LACC\Criteria\CriteriaOnlyTrashedInterface;
use LACC\Repositories\Traits\RepositoryRestoreInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BookRepository
 * @package namespace LACC\Repositories;
 */
interface BookRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface,
    CriteriaOnlyTrashedInterface ,
    RepositoryRestoreInterface
{
    //
}
