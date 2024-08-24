<?php

use App\Http\Controllers\Cards\CardsController;
use App\Http\Controllers\Columns\ColumnsController;

Route::as('columns.')
    ->prefix('/boards')
    ->controller(ColumnsController::class)
    ->group(function () {
        Route::put('columns/sorting', 'sorting')->name('sorting');

        Route::put('columns/{board_column}', 'update')->name('update');
        Route::delete('columns/{board_column}', 'destroy')->name('delete');

        Route::post('{board_column}/cards', [CardsController::class, 'store'])->name('cards.store');
    });
