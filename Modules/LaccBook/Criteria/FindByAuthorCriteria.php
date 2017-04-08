<?php
namespace LaccBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByAuthorCriteria
 * @package namespace LACC\Criteria;
 */
class FindByAuthorCriteria implements CriteriaInterface
{
    /**
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        if ( !\Auth::user()->can( config( 'laccbook.acl.permissions.book_manage_all' ) ) ) {
            return $model->where( 'author_id', \Auth::user()->id );
        }

        return $model;
    }
}
