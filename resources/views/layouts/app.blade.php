<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO</title>
    <style>
        html, input, button {
            font-size: 5vw;
        }

        body {
            margin: 10%;
            font-family: Arial, sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-around;
        }

        nav button {
            width: 230px;
            padding: 20px;
            background-color: dimgrey;
            color: white;
        }

        .controle_liste {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .liste_de_produits {
            display: flex;
            flex-direction: column;
            row-gap: 8px;
            height: 600px;
            overflow-y: auto;
        }

        .formulaire_nouveau_produit {
            display: flex;
            flex-direction: column;
            row-gap: 15px;
        }

        .produit_dans_liste {
            display: flex;
            flex-direction: row;
            column-gap: 5%;
        }

        .produit_checkbox {
            width: 10%;
        }

        input[type="checkbox"] {
            width: 50px;
            height: 50px;
        }

        .produit_nom {
            width: 60%;
        }

        .ligne_formulaire_nouveau_produit {
            display: flex;
            flex-direction: column;
        }

        .labels_nouveau_produit {
            margin-top: 15px;
        }

        .produit_quantite {
            width: 30%;
        }

        .input-inline {
            border: none;
            border-bottom: 1px solid black;
            outline: none;
            padding: 0px 2px;
            width: 100%
        }

        button {
            cursor: pointer;
            width: fit-content;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .bouton {
            color: buttontext;
            display: inline-block;
            text-align: center;
            align-items: flex-start;
            cursor: pointer;
            box-sizing: border-box;
            background-color: buttonface;
            margin: 0em;
            padding: 1px 6px;
            border-width: 1px;
            border-radius: 3px;
            border-style: outset;
            border-color: buttonborder;
            border-image: initial;
        }

        .suggestion {
            cursor: pointer;
            padding-inline: 3px;
        }

        .suggestion:hover {
            background-color: #cbd5e0;
        }

        #suggestions_categorie, #suggestions_produit {
            color: #2d3748;
        }

        .selected_list_button {
            color: red;
        }

        .unselected_list_button {
            color: blue;
        }
    </style>
</head>
<body>
<nav>
    <button id="bouton_1" ><a href="{{ route('listes.show', ['liste' => 1]) }}">Courses</a></button>
    <button id="bouton_2" ><a href="{{ route('listes.show', ['liste' => 2]) }}">Achats</a></button>
    <button id="bouton_3" ><a href="{{ route('listes.show', ['liste' => 3]) }}">To do</a></button>
</nav>
<br>
@yield('content')
</body>
</html>

