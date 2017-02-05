<?php

namespace LACC\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByAuthorCriteria
 * @package namespace LACC\Criteria;
 */
class FormAvancedSearch implements CriteriaInterface
{
    protected $data;
    /**
     * UserAvancedSearch constructor.
     */
    public function __construct( $params  )
    {
        $this->data = $params;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        ( isset( $this->data['name'] ) ) ? $name   = $this->data['name'] :  $name ='' ;
        ( isset( $this->data['num_cpf'] ) ) ? $cpf = $this->data['num_cpf'] :  $cpf ='' ;
        ( isset( $this->data['num_rg'] ) ) ? $rg   = $this->data['num_rg'] :  $rg ='' ;
        ( isset( $this->data['email'] ) ) ? $email   = $this->data['email'] :  $email ='' ;
        ( isset( $this->data['district'] ) ) ? $district   = $this->data['district'] :  $district ='' ;

        return $model
            ->where( 'name','LIKE', "%{$name}%" )
            ->where( 'num_cpf','LIKE', "%{$cpf}%" )
            ->where( 'num_rg','LIKE', "%{$rg}%" )
            ->where( 'email','LIKE', "%{$email}%" )
            //->where( "address.district",'LIKE', "%{$district}%" )
            //->where( 'district','LIKE', "%{$district}%" )
            ;
    }
}
