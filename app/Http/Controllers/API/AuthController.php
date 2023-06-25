<?php 

namespace App\Http\Controllers\API;

use App\Actions\Auth\AuthActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterUserRequest;
use App\Http\Requests\API\User\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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

    /**
     * Register user request.
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
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

    /**
     * Login request.
     * 
     * @param LoginRequest $request
     * 
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse 
    {
        $result = $this->authActions->handleUserLogin($request->toArray());

        return response()->json($result, $result['status']);
    }

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->each(fn ($token) => $token->revoke());
        return response()->json([ 'message' => 'Logout Success'], 200);
    }
}