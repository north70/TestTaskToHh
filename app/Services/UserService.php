<?php

namespace App\Services;

use App\Dto\PaginateDto;
use App\Helpers\PaginateHelper;
use App\Models\User;

class UserService
{
    public function getAll(PaginateDto $dto): array
    {
        $users = User::query()->orderByDesc('created_at');

       return PaginateHelper::paginate($users, $dto);
    }
}
