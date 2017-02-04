<?php
/**
 * File: CityService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 04/02/17
 * Time: 17:24
 * Project: lacc_editora
 * Copyright: 2017
 */

namespace LACC\Services;

use LACC\Models\City;

class CityService extends BaseService
{
    /**
     * @var City
     */
    protected $citymodel;

    public function __construct(City $city)
    {
        $this->citymodel = $city;
    }


    public function getListCitiesInSelect()
    {
        $cities  = [ '' => '--select an city--' ];
        $cities += $this->citymodel->orderby( 'nom_city', 'asc' )->pluck( 'nom_city','id' )->all();

        return $cities;
    }
}