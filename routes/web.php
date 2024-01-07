<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;

Route::get('/categories/suggestions', [CategorieController::class, 'suggestions'])->name('categories.suggestions');
Route::get('/produits/suggestions', [ProduitController::class, 'suggestions'])->name('produits.suggestions');
Route::get('/produit/categorie', [ProduitController::class, 'categorie'])->name('produit.categorie');

Route::redirect('/','listes/1');

Route::resources([
    'listes' => ListeController::class,
]);
Route::resource('produits', ProduitController::class)->except(['show']);
Route::resource('categories', CategorieController::class)->except(['show']);

Route::get('produits/{produit}/from_liste/{from_liste_id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('categories/{category}/from_liste/{from_liste_id}', [CategorieController::class, 'show'])->name('categories.show');
