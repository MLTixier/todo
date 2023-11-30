<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TODO</title>
        <style>
            body{
                width: 600px;
            }
            nav {
                display: flex;
                column-gap: 30px;
            }
            .controle_liste{
                display: flex;
                column-gap: 20px;
                margin-bottom: 20px;
            }
            .liste_de_produits{
                display: flex;
                flex-direction: column;
                row-gap: 8px;
                height: 100px;
                overflow-y: auto;
            }
            .formulaire_nouveau_produit {
                display: flex;
                flex-direction: column;
                row-gap: 8px;
            }
            .produit_dans_liste {
                display: flex;
                flex-direction: row;
                column-gap: 22px;
            }
            .produit_checkbox {
                width: 20px;
            }
            .produit_nom {
                width: 180px;
            }
            .ligne_formulaire_nouveau_produit {
                display: flex;
                column-gap: 20px;
            }
            .labels_nouveau_produit {
                width: 150px;
            }
            .input-inline {
                border: none;
                border-bottom: 1px solid black;
                outline: none;
                padding: 0px 2px;
            }
            button{
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
            .suggestion{
                cursor: pointer;
                width: 180px;
                padding-inline: 3px;
            }
            .suggestion:hover{
                background-color: #cbd5e0;
            }
            #suggestions_categorie, #suggestions_produit {
                margin-left: 170px;
                margin-top: -5px;
            }
        </style>
    </head>
    <body>
        <nav>
            <button><a id="bouton_courses" href="{{ route('listes.show', ['liste' => 1]) }}">Courses</a></button>
            <button><a id="bouton_achats" href="{{ route('listes.show', ['liste' => 2]) }}">Achats</a></button>
            <button><a id="bouton_todo" href="{{ route('listes.show', ['liste' => 3]) }}">To do</a></button>
        </nav>
        <br>
        @yield('content')
    </body>
</html>
