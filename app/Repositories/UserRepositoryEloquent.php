<?php

namespace LACC\Repositories;

use LACC\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
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
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
