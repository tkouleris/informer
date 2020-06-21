<?php


namespace App\Services;


use App\Exceptions\UserException;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Hashing\HashManager;

class UserService
{
    protected $UserRepository;
    protected $hashManager;

    /**
     * UserService constructor.
     * @param IUserRepository $UserRepository
     * @param HashManager $hashManager
     */
    public function __construct(IUserRepository $UserRepository, HashManager $hashManager)
    {
        $this->UserRepository = $UserRepository;
        $this->hashManager = $hashManager;
    }

    public function update_password($user_id, $new_password, $confirm_password)
    {
        if($new_password !== $confirm_password)
        {
            throw new UserException("Password not match");
        }
        $update_password_args = [
            'id'=> $user_id,
            'password' => $this->hashManager->make($new_password)
        ];
        $this->UserRepository->update($update_password_args);
    }

}
