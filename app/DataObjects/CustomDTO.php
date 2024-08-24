<?php

namespace App\DataObjects;

use Spatie\LaravelData\Data;

class CustomDTO extends Data
{
    public function onlyFilled(): array
    {
        return array_filter($this->toArray(), function ($value) {
            return ! is_null($value) && $value !== '';
        });
    }
}
