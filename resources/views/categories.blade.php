@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($categories as $categorie)
                <li><a href="{{ route('categories.show', ['category' => $categorie]) }}">{{ $categorie->liste }} : {{ $categorie->nom }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
