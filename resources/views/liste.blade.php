@extends('layouts.app')

@section('content')
    <!--
    //todo : changer le style du bouton concerné par la liste visible
    <script>
    const button_1 = document.getElementById('bouton_1');
    button_1.color="blue";
    const button_2 = document.getElementById('bouton_2');
    button_2.color="blue";
    const button_3 = document.getElementById('bouton_3');
    button_3.color="blue";
    const selected_list_button = document.getElementById('bouton_'.{{$liste->id}});
    selected_list_button.color="red";
</script>
    -->
    <div class="container">
        <form method="POST" action="{{route('listes.update', ['liste' => $liste])}}">
            @csrf
            @method('PUT')
            <div class="controle_liste">
                <button id="bouton_ajouter_produit"><a href="{{ route('categories.index') }}"
                                                       style="font-size: 8vw">cat</a>
                </button>
                @if($liste->id==1)
                    <button type="submit" name="action" value="vider_la_liste">
                        <img class="image_bouton" src="{{ asset('images/delete_black.png') }}" alt="vider la liste">
                    </button>
                @endif
                <button id="bouton_ajouter_produit"><a href="{{ route('listes.edit', ['liste' => $liste]) }}"
                                                       style="font-size: 12vw">+</a>
                </button>
                <button type="submit" name="action" value="sauvegarder">
                    <img class="image_bouton" src="{{ asset('images/save_black.png') }}" alt="sauvegarder">
                </button>
            </div>
            <input name="liste_id" type="hidden" value="{{$liste->id}}"/>
            @if($produits->isEmpty())
                <p>La liste "{{$liste->nom}}" est vide.</p>
            @endif
            <div class="liste_de_produits">
                @foreach ($categories as $categorie)
                    <p>{{ $categorie->nom }}</p>
                @foreach ($produits->where('categorie', $categorie->id) as $produit)
                    <div class="produit_dans_liste">
                        <div class="produit_checkbox">
                            <input type="checkbox"
                                   name="{{ $produit->id }}_est_coche" {{ $produit->pivot->est_coche ? 'checked' : '' }} />
                        </div>
                        <div class="produit_nom">
                            <label><a
                                    href="{{ route('produits.show', ['produit' => $produit->id, 'from_liste_id' => $liste->id]) }}">{{ $produit->nom }}</a></label>
                        </div>
                        @if ($liste->id == 1)
                            <div class="produit_quantite">
                                <input class="input-inline" name="{{ $produit->id }}_quantite" type="text"
                                       value="{{ $produit->pivot->quantite }}">
                            </div>
                        @endif
                        <button class="bouton_supprimer_produit" type="submit" name="action"
                                value="supprimer_produit_{{ $produit->id }}">X
                        </button>
                    </div>
                @endforeach
                @endforeach
            </div>
        </form>
    </div>
@endsection
