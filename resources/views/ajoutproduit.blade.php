@extends('layouts.app')

@section('content')
    <div class="container">
        <p>ajout d'un produit à la liste {{ $liste->nom }} :</p>
        <form method="POST" action="{{route('listes.update', ['liste' => $liste])}}">
            @csrf
            @method('PUT')
            <input type="hidden" id="from_liste" name="from_liste" value="{{$liste->id}}">

            <div class="formulaire_nouveau_produit">
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label for="nouveau_produit">Nom du produit :</label>
                    </div>
                    <input class="input_nouveau_produit" type="text" id="produitInput" name="nouveau_produit" autocomplete="off">
                </div>
                <div id="suggestions_produit"></div>

                <script>
                    //script pour afficher des suggestions de produits existants en BDD
                    const from_liste = document.getElementById('from_liste').value;
                    const produitInput = document.getElementById('produitInput');
                    const produitSuggestions = document.getElementById('suggestions_produit');
                    produitInput.addEventListener('input', function () {
                        const userInput = produitInput.value;
                        const liste = {{ $liste->id }};
                        let tableauSuggestions = [];

                        // Effectuer une requête AJAX pour récupérer les suggestions
                        fetch(`/produits/suggestions?query=${userInput}&liste=${from_liste}`)
                            .then(response => response.json())
                            .then(data => {
                                produitSuggestions.innerHTML = ''; // Nettoyez d'abord la div
                                data.forEach(suggestion => {
                                    produitSuggestions.innerHTML += `<div class="suggestion" id="suggestion_prod_${suggestion}">${suggestion}</div>`; // Ajoutez chaque suggestion dans la div
                                    tableauSuggestions.push(suggestion);
                                });
                            })
                            .then(data => {
                                tableauSuggestions.forEach(function (suggestion) {
                                    document.getElementById('suggestion_prod_' + suggestion).addEventListener('click', function () {
                                        produitInput.value = document.getElementById('suggestion_prod_' + suggestion).innerText; //en cas de clic sur une suggestion, le champ se remplit
                                        produitSuggestions.innerHTML = ''; //et la liste déroulante disparaît

                                        //todo: ajouter la catégorie du produit dans le champ catégorie
                                        fetch(`/produit/categorie?query=${suggestion}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                let categorieInput = document.getElementById('categorieInput');
                                                categorieInput.value = data;
                                            })

                                    });
                                });
                            });
                    });
                </script>

                @if ($liste->id == 1)
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label class="labels_nouveau_produit" for="nouvelle_quantite">Quantité :</label>
                    </div>
                    <input class="input_nouveau_produit" name="nouvelle_quantite" type="text">
                </div>
                @else
                    <input type="hidden" name="nouvelle_quantite">
                @endif

                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label class="labels_nouveau_produit" for="nouvelle_categorie">Catégorie :</label>
                    </div>
                    <input class="input_nouveau_produit" type="text" id="categorieInput" name="nouvelle_categorie" autocomplete="off">
                </div>
                <div id="suggestions_categorie"></div>

                <script>
                    //script pour afficher des suggestions de catégories existantes en BDD
                    let categorieInput = document.getElementById('categorieInput');
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
                    <button type="submit" name="action" value="ajouter_produit">
                        <img class="image_bouton" src="{{ asset('images/save_black.png') }}" alt="sauvegarder">
                    </button>
                    <button name="action" value="annuler">
                        <a href="{{ route('listes.show', ['liste' => $liste->id]) }}" style="font-size: 8vw">X</a>
                    </button>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
