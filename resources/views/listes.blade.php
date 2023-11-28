@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($listes as $liste)
                <li>{{ $liste->nom }}</li>
            @endforeach
        </ul>
    </div>
@endsection
