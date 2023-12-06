@extends('layouts.app')

@section('content')
    <!--
    //todo: refacto scripts
    // Fonction pour gérer l'action avec des arguments spécifiques
    const handleEvent = (arg1, arg2) => {
    // Votre logique avec les arguments
    console.log("Événement détecté avec les arguments :", arg1, arg2);
    };

    // Ajouter des écouteurs pour les événements 'click' et 'input'
    inputField.addEventListener('click', () => handleEvent(arg1, arg2));
    inputField.addEventListener('input', () => handleEvent(arg1, arg2));
    -->

    <div class="container">
        <form method="POST" action="{{route('produits.update', ['produit' => $produit])}}">
            @csrf
            @method('PUT')
            <input type="hidden" id="from_liste" name="from_liste" value="{{$from_liste}}">

            <div class="formulaire_nouveau_produit">
                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label for="nouveau_produit">Nom du produit :</label>
                    </div>
                    <input class="input_nouveau_produit" type="text" id="produitInput" name="nouveau_produit" autocomplete="off"
                           value="{{$produit -> nom}}">
                </div>
                <div id="suggestions_produit"></div>

                <script>
                    //script pour afficher des suggestions de produits existants en BDD
                    const from_liste = document.getElementById('from_liste').value;
                    const produitInput = document.getElementById('produitInput');
                    const produitSuggestions = document.getElementById('suggestions_produit');
                    produitInput.addEventListener('input', function () {
                        const userInput = produitInput.value;
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
                                        //todo: si on sélectionne un produit il faut supprimer celui-là
                                    });
                                });
                            });
                    });
                </script>


                <div class="ligne_formulaire_nouveau_produit">
                    <div class="labels_nouveau_produit">
                        <label class="labels_nouveau_produit" for="nouvelle_categorie">Catégorie :</label>
                    </div>
                    <input class="input_nouveau_produit" type="text" id="categorieInput" name="nouvelle_categorie" autocomplete="off"
                           value="{{$categorie -> nom}}">
                </div>
                <div id="suggestions_categorie"></div>

                <script>
                    //script pour afficher des suggestions de catégories existantes en BDD
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
                    <button type="submit" name="action" value="modifier_produit">
                        <img class="image_bouton" src="{{ asset('images/save_black.png') }}" alt="sauvegarder">
                    </button>
                    <button name="action" value="supprimer_produit">
                        <img class="image_bouton" src="{{ asset('images/delete_black.png') }}"
                             alt="supprimer le produit">
                    </button>
                    <button name="action" value="annuler"><a href="{{ route('listes.show', ['liste' => $from_liste]) }}"
                                                             style="font-size: 8vw"><-</a></button>
                </div>
        </form>
    </div>
@endsection
