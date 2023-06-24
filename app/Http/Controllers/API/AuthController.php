<?php 

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->last_name,
            'username' => $request->username,
            'address' => $request->address ,
            'password' => bcrypt($request->password),
            'postcode' => $request->postcode,
        ]);

        $token = $user->createToken('PassportAuthToken')->accessToken;

        return response()->json([ 'token' => $token ], 200);
    }
}