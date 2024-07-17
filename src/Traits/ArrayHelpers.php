<?php

namespace App\Traits;

trait ArrayHelpers
{
    protected function clearEmptyValues(array $array): array
    {
        return array_filter($array, fn(mixed $value) => !empty($value));
    }
}
