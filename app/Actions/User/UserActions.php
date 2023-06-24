<?php 

namespace App\Actions\User;

use App\DataTransferObjects\UserData;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserActions 
{
    /**
     * @param array $data
     * 
     * @return User
     */
    public function handleRecordCreation(array $data): User 
    {
        return DB::transaction(fn () => app(CreateUserAction::class)->execute(new UserData(
            first_name: $data['first_name'],
            last_name: $data['last_name'],  
            email: $data['email'],
            address: $data['address'],
            username: $data['username'],
            password: $data['password'],
            postcode: $data['postcode']
        )));
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return User
     */
    public function handleRecordUpdate(int $id, array $data): User
    {
        return DB::transaction(fn () => app(UpdateUserAction::class)->execute($id, new UserData(
            first_name: $data['first_name'],
            last_name: $data['last_name'],  
            email: $data['email'],
            address: $data['address'],
            username: $data['username'],
            password: $data['password'],
            postcode: $data['postcode']
        )));
    }

    /**
     * @param int $id
     * 
     * @return User
     */
    public function handleRecordDeletion(int $id): User
    {
        return DB::transaction(fn () => app(DeleteUserAction::class)->execute($id));
    }
}