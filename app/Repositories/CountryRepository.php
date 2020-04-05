<?php


namespace App\Repositories;


use App\Models\Country;
use App\Repositories\Interfaces\ICountryRepository;

class CountryRepository implements ICountryRepository
{

    protected $model;

    /**
     * CountryRepository constructor.
     * @param $model
     */
    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    /**
     * @param $CountryID
     * @return mixed
     */
    public function find_by_id($CountryID)
    {
        return $this->model::where('CountryID',$CountryID)->first();
    }

    public function all()
    {
        return $this->model::all();
    }
}
