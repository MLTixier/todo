@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($produits as $produit)
                <li>
                    <input type="checkbox" id="{{ $produit->id }}" name="{{ $produit->id }}" {{ $produit->pivot->est_coche ? 'checked' : '' }} />
                    <label for="{{ $produit->id }}">{{ $produit->id }} : {{ $produit->nom }}</label>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
