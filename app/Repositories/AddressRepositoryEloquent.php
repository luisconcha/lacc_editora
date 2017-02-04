<?php

namespace LACC\Repositories;

use LACC\Models\Address;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AddressRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class AddressRepositoryEloquent extends BaseRepository implements AddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Address::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
