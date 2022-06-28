<?php

namespace App\Helpers;

use App\Dto\BaseDto;
use App\Dto\PaginateDto;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class PaginateHelper
{
    public static function paginate(EloquentBuilder|QueryBuilder $query, PaginateDto $dto): array
    {
        $count = $query->count();
        $items = $query->forPage($dto->page,$dto->limit)->get();

        return [
            'items' => $items,
            'count' => $count
        ];
    }
}
