<?php

namespace LACC\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByTitleCriteria
 * @package namespace LACC\Criteria;
 */
class FindByTitleCriteria implements CriteriaInterface
{
    private $title;

    /**
     * FindByTitleCriteria constructor.
     * @param $title
     */
    public function __construct( $title )
    {
        $this->title = $title;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where( 'title', 'LIKE', "%{$this->title}%" );
    }
}
