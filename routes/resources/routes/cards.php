<?php

use App\Http\Controllers\Cards\CardAttachmentsController;
use App\Http\Controllers\Cards\CardLabelsController;
use App\Http\Controllers\Cards\CardsController;
use App\Http\Controllers\Todos\TodosController;

Route::as('cards.')
    ->prefix('/cards')
    ->controller(CardsController::class)
    ->group(function () {
        Route::put('sorting', 'sorting')->name('sorting');

        Route::get('{card}', 'show')->name('show');
        Route::put('{card}', 'update')->name('update');
        Route::delete('/{card}', 'destroy')->name('delete');

        Route::get('{card}/attachments', [CardAttachmentsController::class, 'index'])->name('attachments.index');
        Route::post('{card}/attachments', [CardAttachmentsController::class, 'store'])->name('attachments.store');
        Route::delete('attachments/{card_attachment}', [CardAttachmentsController::class, 'destroy'])->name('attachments.delete');

        Route::get('{card}/todos', [TodosController::class, 'index'])->name('todos.index');
        Route::post('{card}/todos', [TodosController::class, 'store'])->name('todos.store');
        Route::put('{card}/todos/sorting', [TodosController::class, 'sorting'])->name('todos.sorting');

        Route::put('todos/{card_todo}', [TodosController::class, 'update'])->name('todos.update');
        Route::delete('todos/{card_todo}', [TodosController::class, 'destroy'])->name('todos.delete');

        Route::get('{card}/labels', [CardLabelsController::class, 'index'])->name('labels.index');

        Route::put('{card}/labels/{label}/attach', [CardLabelsController::class, 'attach'])->name('labels.attach');
        Route::put('{card}/labels/{label}/detach', [CardLabelsController::class, 'detach'])->name('labels.detach');
    });
