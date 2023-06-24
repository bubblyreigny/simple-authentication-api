<?php 

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryContract
{
    /**
     * @return User
     */
    public function getAllUsers(): Collection;

    /**
     * @param int $id
     * 
     * @return User
     */
    public function showUser(int $id): User;
}