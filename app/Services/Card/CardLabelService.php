<?php

namespace App\Services\Card;

use App\Exceptions\Card\MaximumLabelsException;
use App\Models\BoardLabel;
use App\Models\Card;

class CardLabelService
{
    /**
     * @throws MaximumLabelsException
     */
    public function attach(Card $card, BoardLabel $label): BoardLabel
    {
        if ($card->labels()->count() >= 5) {
            throw new MaximumLabelsException('The maximum of labels has been reached.', 422);
        }

        $card->labels()->sync($label, false);

        return $label;
    }

    public function detach(Card $card, BoardLabel $label): void
    {
        $card->labels()->detach($label);
    }
}
