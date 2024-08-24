<?php

namespace App\DataObjects\Card;

use App\DataObjects\CustomDTO;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;

class CardAttachmentDTO extends CustomDTO
{
    public function __construct(
        public string $caption,
        public string $path,
        public string $filename,
        public string $extension,
    ) {
        //
    }
}
