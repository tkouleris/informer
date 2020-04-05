<?php


namespace App\Repositories;


use App\Models\Setting;
use App\Repositories\Interfaces\ISettingRepository;

class SettingRepository implements ISettingRepository
{
    protected $model;

    /**
     * SettingRepository constructor.
     * @param $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }
}
