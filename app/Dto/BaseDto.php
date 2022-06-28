<?php

namespace App\Dto;

abstract class BaseDto
{
    private array $attributes;
    private array $params;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->attributes[] = $key;
            if (!is_null($value)) {
                $this->params[$key] = $value;
            }
            $this->$key = $value;
        }
    }

    /**
     * Получить атрибуты
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Получить ключ - значение
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
