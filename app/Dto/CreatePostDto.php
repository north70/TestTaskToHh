<?php

namespace App\Dto;

class CreatePostDto extends BaseDto
{
    public string $title;
    public int $category_id;
}
