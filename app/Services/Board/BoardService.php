<?php

namespace App\Services\Board;

use App\DataObjects\Board\BoardDTO;
use App\Models\Board;

class BoardService
{
    public function __construct(public Board $board)
    {
        //
    }

    public function create(BoardDTO $boardDTO): Board
    {
        return auth()->user()->boards()->create($boardDTO->toArray());
    }

    public function update(Board $board, BoardDTO $boardDTO): Board
    {
        return tap($board)->update($boardDTO->onlyFilled());
    }

    public function delete(Board $board): ?bool
    {
        return $board->delete();
    }
}
