<?php

namespace LACC\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LACC\Repositories\TelephoneUserRepository;
use LACC\Models\TelephoneUser;
use LACC\Validators\TelephoneUserValidator;

/**
 * Class TelephoneUserRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class TelephoneUserRepositoryEloquent extends BaseRepository implements TelephoneUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TelephoneUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
