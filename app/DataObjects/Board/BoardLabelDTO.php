<?php

namespace App\DataObjects\Board;

use Spatie\LaravelData\Data;

class BoardLabelDTO extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $color,
    ) {}
}
