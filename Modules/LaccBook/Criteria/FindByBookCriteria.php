<?php
namespace LaccBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByBookCriteria
 * @package namespace LACC\Criteria;
 */
class FindByBookCriteria implements CriteriaInterface
{
    private $bookId;

    public function __construct( $bookId )
    {
        $this->bookId = $bookId;
    }

    /**
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        return $model->where( 'book_id', $this->bookId );
    }
}
