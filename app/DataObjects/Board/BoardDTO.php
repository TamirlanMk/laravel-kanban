<?php

namespace App\DataObjects\Board;

use App\DataObjects\CustomDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;

class BoardDTO extends CustomDTO
{
    public function __construct(
        public string $name,
        public ?bool $is_public,
    ) {
        //
    }
}
