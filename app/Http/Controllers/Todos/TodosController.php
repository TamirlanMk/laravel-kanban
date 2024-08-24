<?php

namespace App\Http\Controllers\Todos;

use App\DataObjects\Card\CardTodoDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardTodoSortingRequest;
use App\Http\Requests\CardTodoStoreRequest;
use App\Http\Requests\CardTodoUpdateRequest;
use App\Http\Resources\CardTodo\CardTodoResource;
use App\Models\Card;
use App\Models\CardTodo;
use App\Services\Card\CardTodoService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TodosController extends Controller
{
    public function __construct(
        public CardTodoService $todosService
    ) {}

    public function index(Card $card): AnonymousResourceCollection
    {
        $todos = $card->todos()->get();

        return CardTodoResource::collection($todos);
    }

    public function store(CardTodoStoreRequest $request, Card $card): CardTodoResource
    {
        $newTodo = $this->todosService->store(
            $card, CardTodoDTO::from($request->validated())
        );

        return CardTodoResource::make($newTodo);
    }

    public function update(CardTodoUpdateRequest $request, CardTodo $cardTodo): CardTodoResource
    {
        $updatedTodo = $this->todosService->update(
            $cardTodo, CardTodoDTO::from($request->validated())
        );

        return CardTodoResource::make($updatedTodo);
    }

    public function sorting(CardTodoSortingRequest $request)
    {
        $this->todosService->sorting($request->validated()['todos']);

        return response()->noContent();
    }

    public function destroy(CardTodo $cardTodo)
    {
        $this->todosService->delete($cardTodo);

        return response()->noContent();
    }
}
