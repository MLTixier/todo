<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Liste;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $listes = Liste::All();

        return view('listes', [
            'listes' => $listes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): \Illuminate\Contracts\View\View
    {
        $liste = Liste::findOrFail($id);
        $produits = $liste->produits->sortBy('categorie');
        $categoriesIds = $liste->produits->pluck('categorie')->unique();
        $categories = Categorie::whereIn('id', $categoriesIds)->get();
        return view('liste', [
            'liste' => $liste,
            'produits' => $produits,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $liste = Liste::findOrFail($id);

        return view('ajoutproduit', [
            'liste' => $liste,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $liste = Liste::findOrFail($id);
        $produits = $liste->produits;

        try {
            DB::beginTransaction();
            //réalisation d'opérations sur la BDD.

            if ($request->has('action')) {
                $action = $request->input('action');

                if ($action === 'vider_la_liste') {
                    //todo: mettre un message de confirmation
                    foreach ($produits as $produit) {
                        $liste->produits()->detach($produit->id);
                        //si $liste = 2 ou 3, les produits associés sont supprimés de la BDD car pas d'intérêt à ce qu'ils y restent.
                        if ($id !== 1) {
                            $produit->delete();
                        }
                    }
                    info('la liste ' . $liste->nom . 'a été vidée');

                } elseif ($action === 'sauvegarder') {
                    $this->sauvegarder_liste($request, $liste);

                } elseif ($action === 'ajouter_produit') {
                    $this->ajouter_produit_a_liste($request, $liste);

                } elseif (substr($action, 0, 18) === 'supprimer_produit_') {
                    info(0);
                    $nom_produit = substr($action, 18);
                    $this->supprimer_produit_de_liste($nom_produit, $liste);
                }
            }
            $liste->save();

            DB::commit();
            //toutes les opérations sur le BDD sont terminées.

            return redirect()->route('listes.show', ['liste' => $liste]);

        } catch (\Exception $e) {
            DB::rollBack();
            info("Une erreur s'est produite lors des opérations de base de données");
            info($e);
            return redirect()->route('listes.show', ['liste' => $liste]);
        }

    }

    public function sauvegarder_liste($request, $liste)
    {
        foreach ($liste->produits as $produit) {
            $produit_id = $produit->id;
            $rules_produit = [
                $produit_id . '_est_coche' => 'nullable|string|max:2',
                $produit_id . '_quantite' => 'nullable|string|max:100',
            ];
            $validated = $request->validate($rules_produit);
            $liste->produits()->updateExistingPivot($produit_id, [
                'est_coche' => array_key_exists($produit_id . '_est_coche', $validated),
                'quantite' => $validated[$produit_id . '_quantite'],
            ]);
        }
        info('la liste ' . $liste->nom . ' a été sauvegardée');
    }

    public function ajouter_produit_a_liste($request, $liste)
    {
        $rules_produit = [
            'nouveau_produit' => 'required|string|max:100',
            'nouvelle_quantite' => 'nullable|string|max:100',
            'nouvelle_categorie' => 'nullable|string|max:100',
        ];
        $validated = $request->validate($rules_produit);

        $nom_produit = $validated['nouveau_produit']; // Chaîne de recherche
        $produit = Produit::where('nom', 'LIKE', $nom_produit)->first();

        if ($produit) {
            // Le produit existe déjà
            //Vérification de si le produit n'est pas déjà dans la liste :
            $produitPresent = $liste->produits()->where('produit_id', $produit->id)->exists();
            if (!$produitPresent) {
                $liste->produits()->attach($produit->id, ['quantite' => $validated['nouvelle_quantite']]);
                info('le produit ' . $produit->nom . ' a été ajouté à la liste');
            } else {
                //todo: mettre un message d'erreur si le produit est déjà dans la liste (cas else)
                info('le produit ' . $produit->nom . ' est déja dans la liste.');
            }
        } else {
            // Le produit n'existe pas et doit être créé.
            info("le produit " . $nom_produit . " n'existe pas et doit etre créé");

            $categorie_id = 0;
            $nom_categorie = $validated['nouvelle_categorie']; // Chaîne de recherche
            $categorie = Categorie::where('nom', 'LIKE', $nom_categorie)->first();

            if ($categorie) {
                // La catégorie existe déjà
                $categorie_id = $categorie->id;
            } else {
                // La catégorie n'existe pas et doit être créé.
                $nouvelleCategorie = Categorie::create([
                    'nom' => $validated['nouvelle_categorie'],
                    'liste' => $liste->id,
                ]);
                info('la catégorie' . $nouvelleCategorie->nom . 'a été créée');
                $categorie_id = $nouvelleCategorie->id;
            }

            //création du nouveau produit et ajout à la liste.
            $nouveauProduit = Produit::create([
                'nom' => $validated['nouveau_produit'],
                'categorie' => $categorie_id,
            ]);
            $liste->produits()->attach($nouveauProduit->id, ['quantite' => $validated['nouvelle_quantite']]);
            info('le nouveau produit ' . $nouveauProduit->nom . ' a été créé et ajouté à la liste');
        }
    }

    public function supprimer_produit_de_liste($produit_id_a_supprimer, $liste)
    {
        //todo: mettre un message de confirmation
        $liste->produits()->detach($produit_id_a_supprimer);
        $produit_nom_a_supp = Produit::findOrFail($produit_id_a_supprimer);
        if ($liste->id !== 1) {
            $produit = Produit::findOrFail($produit_id_a_supprimer);
            $produit->delete();
            info('le produit ' . $produit_nom_a_supp->nom . ' a été enlevé de la liste et supprimé');
        } else {
            info('le produit ' . $produit_nom_a_supp->nom . ' a été enlevé de la liste');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
