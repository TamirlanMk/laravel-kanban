<?php

use App\Http\Controllers\Boards\BoardLabelsController;
use App\Http\Controllers\Boards\BoardsController;
use App\Http\Controllers\Columns\ColumnsController;

Route::as('boards.')
    ->prefix('/boards')
    ->controller(BoardsController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::get('/{board}', 'show')->name('show');
        Route::put('/{board}', 'update')->name('update');
        Route::delete('/{board}', 'destroy')->name('delete');

        Route::post('{board}/columns', [ColumnsController::class, 'store'])->name('columns.store');

        Route::get('{board}/labels', [BoardLabelsController::class, 'index'])->name('labels.index');
        Route::post('{board}/labels', [BoardLabelsController::class, 'store'])->name('labels.store');
        Route::post('/labels/{board_label}', [BoardLabelsController::class, 'destroy'])->name('labels.delete');
    });
