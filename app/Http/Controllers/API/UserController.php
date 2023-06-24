<?php 

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Transformers\User\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Fractal\Fractal;
use Throwable;

class UserController extends BaseController
{
    /**
     * Display all users available.
     * 
     * @param Request $request
     * 
     * @return Fractal
     */
    public function index(Request $request): Fractal
    {
        $user = User::all();

        return $this->fractal($user, new UserTransformer);
    }

    /**
     * Display the specific user.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return Fractal
     */
    public function show(Request $request, int $id): Fractal
    {
        $user = User::findOrFail($id);

        return $this->fractal($user, new UserTransformer);
    }

    /**
     * Create a new user.
     *
     * @param Request $request
     * 
     * @return JsonResponse|Fractal
     */
    public function store(Request $request): JsonResponse|Fractal
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
            'email' => $request->email,
            'username' => $request->username,
            'address' => $request->address ,
            'password' => bcrypt($request->password),
            'postcode' => $request->postcode,
        ]);

        return $this->fractal($user, new UserTransformer);
    }

    /**
     * Update specific user.
     *
     * @param Request $request
     * @param int $id
     * 
     * @return JsonResponse|Fractal
     */
    public function update(Request $request, int $id): JsonResponse|Fractal 
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'address' => 'required' ,
            'password' => 'required|min:8',
            'postcode' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);
        
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'address' => $request->address ,
            'password' => bcrypt($request->password),
            'postcode' => $request->postcode,
        ]);

        return $this->fractal($user, new UserTransformer);
    }
}