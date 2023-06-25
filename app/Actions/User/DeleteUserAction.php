<?php 

namespace App\Actions\User;

use App\DataTransferObjects\UserData;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
class DeleteUserAction 
{
    /**
     * @param int $id
     * 
     * @return User
     * @throws HttpException 
     */
    public function execute(int $id): User 
    {
        if ($id == 1) {
            abort(422, "Sytem adiminitrator cannot be deleted");
        }
    
        $user = User::findOrFail($id);
        $user->delete();
        return $user->refresh();
    }
}