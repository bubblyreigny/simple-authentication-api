<?php 

namespace App\Actions\User;

use App\DataTransferObjects\UserData;
use App\Models\User;

class UpdateUserAction 
{
    /**
     * @param int $id
     * @param UserData $userData
     * 
     * @return User
     */
    public function execute(int $id, UserData $userData): User 
    {
        $user = User::findOrFail($id);

        $user->update([
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'email' => $userData->email,
            'username' => $userData->username,
            'address' => $userData->address ,
            'password' => bcrypt($userData->password),
            'postcode' => $userData->postcode,
        ]);

        return $user->fresh();
    }
}