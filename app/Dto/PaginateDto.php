<?php

namespace App\Dto;

class PaginateDto extends BaseDto
{
    public int $page = 1;
    public int $limit = 10;
}
