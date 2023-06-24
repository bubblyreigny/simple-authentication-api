<?php 

namespace App\Http\Controllers\API;

use App\Actions\User\UserActions;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\User\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Transformers\User\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Fractal\Fractal;
use Throwable;

class UserController extends BaseController
{
    /**
     * Available actions on the user model.
     * 
     * @var UserActions
     */
    protected UserActions $userActions;

    /**
     * Available queries for the user model.
     * 
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * UserController constructor.
     * 
     * @param UserActions $userActions
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserActions $userActions,
        UserRepository $userRepository
    ) {
        $this->userActions = $userActions;
        $this->userRepository = $userRepository;
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
        $user = $this->userRepository->getAllUsers();

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
        $user = $this->userRepository->showUser($id);

        return $this->fractal($user, new UserTransformer);
    }

    /**
     * Create a new user.
     *
     * @param UserRequest $request
     * 
     * @return Fractal
     */
    public function store(UserRequest $request): Fractal
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
     * @return Fractal
     */
    public function update(UserRequest $request, int $id): Fractal 
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
