@extends('layouts.app')

@section('content')
    <div class="container">
        <p>ajout d'un produit à la liste {{ $liste->nom }} :</p>
        <form method="POST" action="{{route('listes.update', ['liste' => $liste])}}">
            @csrf
            @method('PUT')
            <div class="formulaire_nouveau_produit">
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label for="nouveau_nom">Nom du produit :</label>
                    </div>
                    <input name="nouveau_nom" type="text">
                </div>
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label class="labels_nouveau_produit" for="nouvelle_quantite">Quantité :</label>
                    </div>
                    <input name="nouvelle_quantite" type="text">
                </div>
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label class="labels_nouveau_produit" for="nouvelle_categorie">Catégorie :</label>
                    </div>
                        <input name="nouvelle_categorie" type="text">
                </div>
                <button type="submit" name="action" value="sauvegarder">Sauvegarder</button>
            </div>
    </div>
    </form>
    </div>
@endsection
