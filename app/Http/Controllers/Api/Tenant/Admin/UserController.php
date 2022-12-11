<?php

namespace App\Http\Controllers\Api\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        return response([
            'users' => UserResource::collection($this->userService->getUsers())
        ]);
    }

    public function update(User $user, UserRequest $requset)
    {

        $user = $this->userService->update($user, $requset->validated());

        return response([
            'user' => new UserResource($user)
        ]);
    }
}
