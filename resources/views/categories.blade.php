@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($categories as $categorie)
                <li><a href="{{ route('categories.show', ['category' => $categorie, 'from_liste_id' => 0]) }}">{{ $categorie->liste }} : {{ $categorie->nom }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
