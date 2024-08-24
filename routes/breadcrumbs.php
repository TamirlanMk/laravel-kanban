<?php

use App\Models\Board;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('boards.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Boards', route('boards.index'));
});

Breadcrumbs::for('boards.show', function (BreadcrumbTrail $trail, Board $board) {
    $trail->parent('boards.index');
    $trail->push($board->name, route('boards.show', $board));
});
