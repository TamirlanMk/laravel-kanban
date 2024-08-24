<?php

namespace App\Http\Controllers\Boards;

use App\DataObjects\Board\BoardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardStoreRequest;
use App\Http\Requests\BoardUpdateRequest;
use App\Http\Resources\Board\BoardResource;
use App\Models\Board;
use App\Services\Board\BoardService;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class BoardsController extends Controller
{
    public function __construct(public BoardService $boardService)
    {
        //
    }

    public function index(): Response
    {
        $boards = auth()->user()->boards()->get();

        return inertia()->render('Boards/Index', [
            'boards' => BoardResource::collection($boards),
        ]);
    }

    public function store(BoardStoreRequest $request): RedirectResponse
    {
        $this->boardService->create(
            BoardDTO::from($request->validated())
        );

        return to_route('boards.index');
    }

    public function show(Board $board): Response
    {
        $board->load([
            'columns' => function ($q) {
                $q->with(['cards' => function (HasMany $query) {
                    $query->with('labels')->withCount(['attachments', 'comments', 'todos']);
                }]);
            },
        ]);

        return inertia('Boards/Show', [
            'board' => BoardResource::make($board),
        ]);
    }

    public function update(BoardUpdateRequest $request, Board $board): RedirectResponse
    {
        $this->boardService->update($board, BoardDTO::from($request->validated()));

        return back()->with('success', __('board.updated'));
    }

    public function destroy(Board $board): RedirectResponse
    {
        $this->boardService->delete($board);

        return to_route('boards.index')->with('success', __('board.deleted'));
    }
}
