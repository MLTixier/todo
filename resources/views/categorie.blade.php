@extends('layouts.app')

@section('content')

    <div class="container">
        <form method="POST" action="{{route('categories.update', ['category' => $categorie])}}">
            @csrf
            @method('PUT')

            <div class="formulaire_nouveau_produit">
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label for="nom_categorie">Nom de la catégorie :</label>
                    </div>
                    <input class="input_nouveau_produit" type="text" id="categorieInput" name="categorie"
                           autocomplete="off"
                           value="{{$categorie -> nom}}">
                </div>

                <div id="suggestions_categorie"></div>

                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label class="labels_nouveau_produit" for="liste_categorie">appartient à la liste :</label>
                    </div>
                    <input class="input_nouveau_produit" type="text" id="listeCategorieInput" name="liste_categorie"
                           value="{{ ($listes->where('id', $categorie->id)->first)->nom->nom}}">
                </div>

                <script>
                    //script pour afficher des suggestions de catégories existantes en BDD

                    const from_liste = document.getElementById('listeCategorieInput').value;
                    const categorieInput = document.getElementById('categorieInput');
                    const categorieSuggestions = document.getElementById('suggestions_categorie');
                    categorieInput.addEventListener('input', function () {
                        const userInput = categorieInput.value;
                        let tableauSuggestions = [];

                        // Effectuer une requête AJAX pour récupérer les suggestions
                        fetch(`/categories/suggestions?query=${userInput}&liste=${from_liste}`)
                            .then(response => response.json())
                            .then(data => {
                                categorieSuggestions.innerHTML = ''; // Nettoyez d'abord la div
                                data.forEach(suggestion => {
                                    categorieSuggestions.innerHTML += `<div class="suggestion" id="suggestion_cat_${suggestion}">${suggestion}</div>`; // Ajoutez chaque suggestion dans la div
                                    tableauSuggestions.push(suggestion);
                                });
                            })
                            .then(data => {
                                tableauSuggestions.forEach(function (suggestion) {
                                    document.getElementById('suggestion_cat_' + suggestion).addEventListener('click', function () {
                                        categorieInput.value = document.getElementById('suggestion_cat_' + suggestion).innerText; //en cas de clic sur une suggestion, le champ se remplit
                                        categorieSuggestions.innerHTML = ''; //et la liste déroulante disparaît
                                    });
                                });
                            });
                    });
                </script>


                <div class="controle_liste">
                    <button type="submit" name="action" value="modifier_categorie">
                        <img class="image_bouton" src="{{ asset('images/save_black.png') }}" alt="sauvegarder">
                    </button>
                    <button name="action" value="supprimer_categorie">
                        <img class="image_bouton" src="{{ asset('images/delete_black.png') }}"
                             alt="supprimer la categorie">
                    </button>
                    @if($from_liste == 0)
                    <button name="action" value="annuler"><a href="{{ route('categories.index') }}"
                                                             style="font-size: 8vw"><-</a></button>
                    @else
                    <button name="action" value="annuler"><a href="{{ route('listes.show', ['liste' => $from_liste]) }}"
                            style="font-size: 8vw"><-</a></button>
                    @endif
                </div>


        </form>
    </div>
@endsection
