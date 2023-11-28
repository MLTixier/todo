@extends('layouts.app')

@section('content')
    <div class="container">
        <div>Liste {{ $liste->nom }}</div>
        <ul>
            @foreach ($produits as $produit)
                <p>{{ $produit->id }} : {{ $produit->nom }}</p>
            @endforeach
        </ul>
    </div>
@endsection
