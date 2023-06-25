<?php 

namespace App\Http\Controllers\API;

use App\Actions\Auth\AuthActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterUserRequest;
use App\Http\Requests\API\User\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    protected AuthActions $authActions;

    public function __construct(
        AuthActions $authActions,
    ) {
        $this->authActions = $authActions;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'address' => 'required' ,
            'password' => 'required|min:8',
            'postcode' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = $this->authActions->handleUserRegistration($request->toArray());

        return response()->json($user, 200);
    }

    public function login(LoginRequest $request) 
    {
        $result = $this->authActions->handleUserLogin($request->toArray());

        return response()->json($result, $result['status']);
    }
}