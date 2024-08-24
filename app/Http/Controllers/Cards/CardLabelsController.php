<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardLabelStoreRequest;
use App\Http\Resources\BoardLabel\BoardLabelResource;
use App\Models\BoardLabel;
use App\Models\Card;
use App\Services\Board\BoardLabelService;
use App\Services\Card\CardLabelService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CardLabelsController extends Controller
{
    public function __construct(
        public CardLabelService $cardLabelService,
        public BoardLabelService $boardLabelService,
    ) {}

    public function index(Card $card): AnonymousResourceCollection
    {
        return BoardLabelResource::collection(
            $card->labels()->get()
        );
    }

    public function store(BoardLabelStoreRequest $request): BoardLabel
    {
        return BoardLabelResource::make(
            $this->store($request->validated())
        );
    }

    public function attach(Card $card, BoardLabel $label): BoardLabelResource
    {
        $this->cardLabelService->attach($card, $label);

        return BoardLabelResource::make($label);
    }

    public function detach(Card $card, BoardLabel $label)
    {
        $this->cardLabelService->detach($card, $label);

        return response()->noContent();
    }

    public function destroy(BoardLabel $boardLabel)
    {
        $this->boardLabelService->delete($boardLabel);

        return response()->noContent();
    }
}
