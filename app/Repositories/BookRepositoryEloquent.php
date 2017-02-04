<?php

namespace LACC\Repositories;

use LACC\Models\Book;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BookRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
