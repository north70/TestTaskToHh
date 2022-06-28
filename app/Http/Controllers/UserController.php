<?php

namespace App\Http\Controllers;

use App\Dto\PaginateDto;
use App\Helpers\JResponse;
use App\Http\Requests\PaginateRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll(PaginateRequest $request)
    {
        $dto = new PaginateDto($request->validated());
        $users = $this->userService->getAll($dto);
        return JResponse::success($users);
    }
}
