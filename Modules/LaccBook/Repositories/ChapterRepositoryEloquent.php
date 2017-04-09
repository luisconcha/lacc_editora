<?php
namespace LaccBook\Repositories;

use LACC\Criteria\CriteriaTrashedTrait;
use LACC\Repositories\Traits\BaseRepositoryTrait;
use LACC\Repositories\Traits\RepositoryRestoreTrait;
use LaccBook\Models\Chapter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ChapterRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{
    use BaseRepositoryTrait,
      CriteriaTrashedTrait,
      RepositoryRestoreTrait;

    protected $fieldSearchable = [
      'id',
      'name'    => 'like',
      'content' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app( RequestCriteria::class ) );
    }
}