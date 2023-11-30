<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;

Route::get('/categories/suggestions', [CategorieController::class, 'suggestions'])->name('categories.suggestions');
Route::get('/produits/suggestions', [ProduitController::class, 'suggestions'])->name('produits.suggestions');

Route::redirect('/','listes/1');

Route::resources([
    'listes' => ListeController::class,
    'categories' => CategorieController::class,
    'produits' => ProduitController::class,
]);
