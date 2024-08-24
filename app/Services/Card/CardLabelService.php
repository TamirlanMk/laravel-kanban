<?php

namespace App\Services\Card;

use App\Models\BoardLabel;
use App\Models\Card;

class CardLabelService
{
    public function attach(Card $card, BoardLabel $label): BoardLabel
    {
        $card->labels()->sync($label,  false);

        return $label;
    }

    public function detach(Card $card, BoardLabel $label): void
    {
        $card->labels()->detach($label);
    }
}
