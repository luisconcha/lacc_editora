<?php

namespace LACC\Repositories;

use LACC\Criteria\CriteriaOnlyTrashedTrait;
use LACC\Models\Category;
use LACC\Repositories\Traits\BaseRepositoryTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait, CriteriaOnlyTrashedTrait;

    protected $fieldSearchable = [
        'id',
        'name' => 'like'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
