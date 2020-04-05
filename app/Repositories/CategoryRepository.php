<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    protected $model;

    /**
     * CategoryRepository constructor.
     * @param $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }


    public function find_by_id($CategoryID)
    {
        return $this->model::where('CategoryID',$CategoryID)->first();
    }

    public function all()
    {
        return $this->model::all();
    }
}
