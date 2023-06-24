<?php 

namespace App\Actions\User;

use App\DataTransferObjects\UserData;
use App\Models\User;

class CreateUserAction 
{
    /**
     * @param UserData $userData
     * 
     * @return User
     */
    public function execute(UserData $userData): User 
    {
        $user = User::create([
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'email' => $userData->email,
            'username' => $userData->username,
            'address' => $userData->address ,
            'password' => bcrypt($userData->password),
            'postcode' => $userData->postcode,
        ]);

        return $user;
    }
}