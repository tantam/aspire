<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:21 PM
 */

namespace Modules\User\Http\Controllers\Api;


use App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\UserCollectionResource;
use Modules\User\Transformers\UserResource;

class UserController extends ApiController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get user list with pagination
     *
     */
    public function all(){

        $users = $this->userRepository->getModel()->paginate();

        return $this->responseSuccess(UserResource::collection($users));
    }
    /**
     * Create new user
     *
     * @param CreateUserRequest $request
     */
    public function create(CreateUserRequest $request){

        $input = $request->validated();

        $user = $this->userRepository->create($input);

        return $this->responseSuccess(new UserResource($user));
    }

    /**
     * Get user detail by ID
     *
     * @param $user_id
     * @return mixed
     */
    public function show($user_id){

        $user = $this->userRepository->find($user_id);

        return $this->responseSuccess(new UserResource($user));
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return mixed
     */
    public function update(Request $request, $user_id){

        $user = $this->userRepository->find($user_id);

        $user = $this->userRepository->update($user,$request->only(['name']));

        return $this->responseSuccess(new UserResource($user));
    }
}
