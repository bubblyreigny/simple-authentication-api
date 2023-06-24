<?php 

namespace App\Actions\Auth;

use App\Actions\User\CreateUserAction;
use App\DataTransferObjects\UserData;

class RegisterAction
{
    public function execute(UserData $userData): array
    {
        $user = app(CreateUserAction::class)->execute($userData);

        $token = $user->createToken('PassportAuthToken')->accessToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}