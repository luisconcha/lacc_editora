<?php

namespace LACC\Repositories;

use LACC\Criteria\CriteriaOnlyTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace LACC\Repositories;
 */
interface CategoryRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface,
    CriteriaOnlyTrashedInterface
{
    //
}
