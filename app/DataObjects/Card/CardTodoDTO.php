<?php

namespace App\DataObjects\Card;

use App\DataObjects\CustomDTO;

class CardTodoDTO extends CustomDTO
{
    public function __construct(
        public ?int $card_id,
        public string $name,
        public ?int $position,
        public ?bool $is_checked,
    ) {}
}
