<?php 

namespace App\Http\Controllers\API;

use App\Actions\User\UserActions;
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

    protected UserActions $userActions;

    public function __construct(UserActions $userActions)
    {
        $this->userActions = $userActions;
    }

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
        $result = $this->userActions->handleRecordCreation($request->toArray());

        return $this->fractal($result, new UserTransformer);
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
        $result = $this->userActions->handleRecordUpdate($id, $request->toArray());

        return $this->fractal($result, new UserTransformer);
    }

    /**
     * Delete specific user.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function delete(Request $request, int $id): JsonResponse|Fractal
    {
        $result = $this->userActions->handleRecordDeletion($id);

        return $this->fractal($result, new UserTransformer);
    }
}
