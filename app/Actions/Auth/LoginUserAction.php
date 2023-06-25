<?php

namespace App\Actions\Auth;

use App\DataTransferObjects\LoginData;
use Illuminate\Support\Facades\Auth;

class LoginUserAction 
{
    public function execute(LoginData $loginData) 
    {
        $data = [
            'email' => $loginData->email,
            'password' => $loginData->password 
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('PassportAuthToken')->accessToken;
            
            return [
                'user' => $user,
                'token' => $token,
                'status' => 200
            ];
        } else {
            return [
                'message' => 'Invalid credentials',
                'status' => 401
            ];
        }
    }
}