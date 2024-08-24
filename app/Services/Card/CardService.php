<?php

namespace App\Services\Card;

use App\DataObjects\Card\CardDTO;
use App\Models\Card;
use Illuminate\Support\Facades\DB;
use Throwable;

class CardService
{
    public function __construct(
        public Card $card,
        public CardAttachmentService $attachmentsService
    ) {
        //
    }

    public function store(CardDTO $cardDTO): Card
    {
        return $this->card->query()
            ->create(array_merge($cardDTO->toArray(), [
                'position' => $this->getLastPosition($cardDTO->board_column_id),
            ]));
    }

    public function update(Card $card, CardDTO $cardDTO): Card
    {
        return tap($card)->update($cardDTO->onlyFilled());
    }

    public function delete(Card $card): ?bool
    {
        $this->attachmentsService->deleteAll($card);

        return $card->delete();
    }

    public function sorting(array $cards): bool
    {
        try {
            DB::transaction(function () use ($cards) {
                foreach ($cards as $card) {
                    $this->card->query()
                        ->where('id', $card['id'])
                        ->update([
                            'position' => $card['position'],
                            'board_column_id' => $card['column_id'],
                        ]);
                }
            });

            return true;
        } catch (Throwable $e) {

            return false;
        }
    }

    private function getLastPosition(int $columnId): ?int
    {
        $lastCard = $this->card->query()
            ->where('board_column_id', $columnId)
            ->orderBy('position', 'desc')
            ->first();

        if (! $lastCard) {
            return 1;
        }

        return $lastCard->position + 1;
    }
}
