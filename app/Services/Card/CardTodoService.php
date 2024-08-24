<?php

namespace App\Services\Card;

use App\DataObjects\Card\CardTodoDTO;
use App\Models\Card;
use App\Models\CardTodo;
use Illuminate\Support\Facades\DB;
use Throwable;

class CardTodoService
{
    public function __construct(
        public CardTodo $cardTodo
    ) {}

    public function store(Card $card, CardTodoDTO $cardTodoDTO): CardTodo
    {
        return $card->todos()->create(array_merge($cardTodoDTO->toArray(), [
            'position' => $this->getLastPosition($card),
            'is_checked' => false,
        ]));
    }

    public function update(CardTodo $cardTodo, CardTodoDTO $cardTodoDTO): CardTodo
    {
        return tap($cardTodo)->update($cardTodoDTO->onlyFilled());
    }

    public function sorting(array $todos): bool
    {
        try {
            DB::transaction(function () use ($todos) {
                foreach ($todos as $todo) {
                    $this->cardTodo->query()
                        ->where('id', $todo['id'])
                        ->update([
                            'position' => $todo['position'],
                        ]);
                }
            });

            return true;
        } catch (Throwable $e) {

            return false;
        }
    }

    public function delete(CardTodo $cardTodo): ?bool
    {
        return $cardTodo->delete();
    }

    private function getLastPosition(Card $card): ?int
    {
        $lastTodo = $card->todos()
            ->orderBy('position', 'desc')
            ->first();

        if (! $lastTodo) {
            return 1;
        }

        return $lastTodo->position + 1;
    }
}
