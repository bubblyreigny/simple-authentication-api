<?php 

namespace App\Actions\User;

use App\DataTransferObjects\UserData;
use App\Models\User;

class DeleteUserAction 
{
    /**
     * @param int $id
     * 
     * @return User
     */
    public function execute(int $id): User 
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user->refresh();
    }
}