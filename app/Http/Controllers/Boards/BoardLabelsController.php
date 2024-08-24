<?php

namespace App\Http\Controllers\Boards;

use App\DataObjects\Board\BoardLabelDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardLabelStoreRequest;
use App\Http\Resources\BoardLabel\BoardLabelResource;
use App\Models\Board;
use App\Models\BoardLabel;
use App\Services\Board\BoardLabelService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BoardLabelsController extends Controller
{
    public function __construct(
        public BoardLabelService $labelService
    ) {}

    public function index(Board $board): AnonymousResourceCollection
    {
        $labels = $board->labels()->get();

        return BoardLabelResource::collection($labels);
    }

    public function store(BoardLabelStoreRequest $request, Board $board): BoardLabelResource
    {
        $label = $this->labelService->store($board, BoardLabelDTO::from($request->validated()));

        return BoardLabelResource::make($label);
    }

    public function destroy(BoardLabel $boardLabel)
    {
        $this->labelService->delete($boardLabel);

        return response()->noContent();
    }
}
