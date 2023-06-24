<?php

namespace App\Actions\Auth;

use App\DataTransferObjects\UserData;
use Illuminate\Support\Facades\DB;

class AuthActions 
{
    public function handleUserRegistration(array $data): array|object
    {
        return DB::transaction(fn ()=> app(RegisterAction::class)->execute(new UserData(
            first_name: $data['first_name'],
            last_name: $data['last_name'],  
            email: $data['email'],
            address: $data['address'],
            username: $data['username'],
            password: $data['password'],
            postcode: $data['postcode']
        )));
    }
}