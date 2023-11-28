<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>TODO - mes listes</title>
        </head>
        <body>
            <div>Mes listes :</div>
        <ul>
            @foreach ($listes as $liste)
                <p>{{ $liste->id }} : {{ $liste->nom }}</p>
            @endforeach
        </ul>
        </body>
    </html>
