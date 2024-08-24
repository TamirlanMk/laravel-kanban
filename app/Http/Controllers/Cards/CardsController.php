<?php

namespace App\Http\Controllers\Cards;

use App\DataObjects\Card\CardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardCardStoreRequest;
use App\Http\Requests\CardSortingRequest;
use App\Http\Requests\CardUpdateRequest;
use App\Http\Resources\Card\CardResource;
use App\Models\BoardColumn;
use App\Models\Card;
use App\Services\Card\CardService;
use Illuminate\Http\RedirectResponse;

class CardsController extends Controller
{
    public function __construct(public CardService $cardService)
    {
        //
    }

    public function show(Card $card): CardResource
    {
        $card->load('labels')
            ->loadCount([
                'attachments',
                'comments', 'todos',
            ]);

        return CardResource::make($card);
    }

    public function store(BoardCardStoreRequest $request, BoardColumn $boardColumn): RedirectResponse
    {
        $this->cardService->store(
            CardDTO::from($request->validated(), ['board_column_id' => $boardColumn->id])
        );

        return back()->with('success', 'card.created');
    }

    public function update(CardUpdateRequest $request, Card $card): CardResource
    {
        $updatedCard = $this->cardService->update($card, CardDTO::from($request->validated()));

        debugbar()->info(CardResource::make($updatedCard));

        return CardResource::make($updatedCard);
    }

    public function sorting(CardSortingRequest $request): RedirectResponse
    {
        $this->cardService->sorting($request->validated('cards'));

        return back();
    }

    public function archive()
    {
        //
    }

    public function destroy(Card $card): RedirectResponse
    {
        $this->cardService->delete($card);

        return back()->with('success', 'card.deleted');
    }
}
