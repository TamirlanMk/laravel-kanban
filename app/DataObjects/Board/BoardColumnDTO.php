<?php

namespace App\DataObjects\Board;

use App\DataObjects\CustomDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;

class BoardColumnDTO extends CustomDTO
{
    public function __construct(
        public string $name,
        public ?int $board_id,
        public ?int $position,
    ) {
        //
    }
}
