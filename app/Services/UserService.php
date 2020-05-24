<?php


namespace App\Services;


use App\Exceptions\UserException;
use App\Repositories\Interfaces\IUserRepository;

class UserService
{
    protected $UserRepository;

    /**
     * UserService constructor.
     * @param $UserRepository
     */
    public function __construct(IUserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function update_password($user_id, $new_password, $confirm_password)
    {
        if($new_password !== $confirm_password)
        {
            throw new UserException("Password not match");
        }
        $update_password_args = [
            'id'=> $user_id,
            'password' => $new_password
        ];
        $this->UserRepository->update($update_password_args);
    }

}
