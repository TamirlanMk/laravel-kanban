<?php

namespace App\Http\Controllers\Columns;

use App\DataObjects\Board\BoardColumnDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoardColumnSortingRequest;
use App\Http\Requests\BoardColumnStoreRequest;
use App\Http\Requests\BoardColumnUpdateRequest;
use App\Models\Board;
use App\Models\BoardColumn;
use App\Services\Board\BoardColumnService;
use Illuminate\Http\RedirectResponse;

class ColumnsController extends Controller
{
    public function __construct(public BoardColumnService $columnService)
    {
        //
    }

    public function store(BoardColumnStoreRequest $request, Board $board): RedirectResponse
    {
        $this->columnService->store(
            $board, BoardColumnDTO::from($request->validated())
        );

        return redirect()->back()->with('success', __('column.created'));
    }

    public function sorting(BoardColumnSortingRequest $request): RedirectResponse
    {
        $this->columnService->sorting($request->validated('columns'));

        return redirect()->back();
    }

    public function update(BoardColumnUpdateRequest $request, BoardColumn $boardColumn): RedirectResponse
    {
        $boardColumnDTO = BoardColumnDTO::from($request->validated());

        $this->columnService->update($boardColumn, $boardColumnDTO);

        return redirect()->back()->with('success', __('column.updated'));
    }

    public function destroy(BoardColumn $boardColumn): RedirectResponse
    {
        $this->columnService->delete($boardColumn);

        return redirect()->back()->with('success', __('column.deleted'));
    }
}
