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
                    <input type="text" id="categorieInput" name="nouvelle_categorie" autocomplete="off">
                </div>
                <div id="suggestions_categorie"></div>

                <script>
                    const categorieInput = document.getElementById('categorieInput');
                    const suggestions = document.getElementById('suggestions_categorie');
                    categorieInput.addEventListener('input', function () {
                        const userInput = categorieInput.value;
                        let tableauSuggestions = [];

                        // Effectuer une requête AJAX pour récupérer les suggestions
                        fetch(`/categories/suggestions?query=${userInput}`)
                            .then(response => response.json())
                            .then(data => {
                                suggestions.innerHTML = ''; // Nettoyez d'abord la div
                                data.forEach(suggestion => {
                                    suggestions.innerHTML += `<div class="suggestion_cat" id="suggestion_cat_${suggestion}">${suggestion}</div>`; // Ajoutez chaque suggestion dans la div
                                    tableauSuggestions.push(suggestion);
                                });
                            })
                            .then(data => {
                                tableauSuggestions.forEach(function (suggestion) {
                                    document.getElementById('suggestion_cat_' + suggestion).addEventListener('click', function () {
                                        categorieInput.value = document.getElementById('suggestion_cat_' + suggestion).innerText; //en cas de clic sur une suggestion, le champ se remplit
                                        suggestions.innerHTML = ''; //et la liste déroulante disparaît
                                    });
                                });
                            });
                    });
                </script>

                <button type="submit" name="action" value="sauvegarder">Sauvegarder</button>
            </div>
    </div>
    </form>
    </div>
@endsection
