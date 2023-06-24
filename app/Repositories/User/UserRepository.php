<?php 

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryContract
{
    /**
     * The repository model.
     * 
     * @var Model
     */
    public Model $model;

    /**
     * UserRepository constructor.
     * 
     * @param User $user
     */
    public function __construct(User $user) 
    {
        $this->model = $user;
    }

    /**
     * Query for all users.
     * @return Collection
     */
    public function getAllUsers(): Collection 
    {
        return $this->model->all();
    }

    /**
     * Query for displaying specific user.
     * 
     * @param int $id
     * 
     * @return User
     */
    public function showUser(int $id): User
    {
        return $this->model->findOrFail($id);
    }
}