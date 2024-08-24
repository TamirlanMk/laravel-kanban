<?php

namespace App\Services\Board;

use App\DataObjects\Board\BoardLabelDTO;
use App\Models\Board;
use App\Models\BoardLabel;

class BoardLabelService
{
    public function store(Board $board, BoardLabelDTO $boardLabelDTO): BoardLabel
    {
        return $board->labels()->create($boardLabelDTO->toArray());
    }

    public function delete(BoardLabel $boardLabel): ?bool
    {
        return $boardLabel->delete();
    }
}
