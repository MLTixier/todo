<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>TODO - ma liste</title>
        </head>
        <body>
            <div>Liste {{ $liste->nom }}</div>
        <ul>
            @foreach ($produits as $produit)
                <p>{{ $produit->id }} : {{ $produit->nom }}</p>
            @endforeach
        </ul>
        </body>
    </html>
