<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;


Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'listes' => ListeController::class,
    'categories' => CategorieController::class,
    'produits' => ProduitController::class,
]);
