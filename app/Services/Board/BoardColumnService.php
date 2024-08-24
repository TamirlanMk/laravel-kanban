<?php

namespace App\Services\Board;

use App\DataObjects\Board\BoardColumnDTO;
use App\Models\Board;
use App\Models\BoardColumn;
use DB;
use Throwable;

class BoardColumnService
{
    public function __construct(
        public Board $board,
        public BoardColumn $boardColumn
    ) {
        //
    }

    public function store(Board $board, BoardColumnDTO $boardColumnDTO): BoardColumn
    {
        return $board->columns()->create(array_merge($boardColumnDTO->toArray(), [
            'position' => $this->getLastPosition($board->id),
        ]));
    }

    public function update(BoardColumn $boardColumn, BoardColumnDTO $boardColumnDTO): BoardColumn
    {
        return tap($boardColumn)->update($boardColumnDTO->onlyFilled());
    }

    public function sorting(array $boardColumns): bool
    {
        try {
            DB::transaction(function () use ($boardColumns) {
                foreach ($boardColumns as $column) {
                    $this->boardColumn->query()
                        ->where('id', $column['id'])
                        ->update([
                            'position' => $column['position'],
                        ]);
                }
            });

            return true;
        } catch (Throwable $e) {
            debugbar()->error($e->getMessage());

            return false;
        }
    }

    public function delete(BoardColumn $boardColumn): ?bool
    {
        return $boardColumn->delete();
    }

    private function getLastPosition(int $boardId): ?int
    {
        $lastColumn = $this->boardColumn->query()
            ->where('board_id', $boardId)
            ->orderBy('position', 'desc')
            ->first();

        if (! $lastColumn) {
            return 1;
        }

        return $lastColumn->position + 1;
    }
}
