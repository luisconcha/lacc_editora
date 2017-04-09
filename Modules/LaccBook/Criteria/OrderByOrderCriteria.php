<?php
namespace LaccBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderByOrderCriteria
 * @package namespace LACC\Criteria;
 */
class OrderByOrderCriteria implements CriteriaInterface
{

    /**
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        return $model->orderBy( 'order', 'asc' );
    }
}
