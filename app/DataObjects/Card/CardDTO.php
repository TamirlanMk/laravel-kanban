<?php

namespace App\DataObjects\Card;

use App\DataObjects\CustomDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;

class CardDTO extends CustomDTO
{
    public function __construct(
        public ?int $id,
        public ?int $board_column_id,
        public ?string $title,
        public ?string $description,
        public ?int $position,

        public ?int $attachments_count,
        public ?int $comments_count,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $ready_at,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $created_at,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updated_at,
    ) {
        //
    }
}
