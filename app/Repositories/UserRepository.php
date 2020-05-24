<?php


namespace App\Repositories;


use App\Repositories\Interfaces\IUserRepository;
use App\User;

class UserRepository implements IUserRepository
{
    protected $model;

    /**
     * UserRepository constructor.
     * @param $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function update($data)
    {
        $User = $this->model::findOrFail($data['id']);
        if(isset($data['password'])) $User->password = $data['password'];

        $User->save();
        return $User;
    }
}
