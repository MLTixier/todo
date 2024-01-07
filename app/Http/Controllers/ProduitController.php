<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Liste;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param int $from_liste_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, int $from_liste_id): \Illuminate\Contracts\View\View
    {
        $produit = Produit::findOrFail($id);
        $categorie = Categorie::findOrFail($produit->categorie);
        return view('produit', [
            'produit' => $produit,
            'categorie' => $categorie,
            'from_liste' => $from_liste_id,
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
        $produit = Produit::findOrFail($id);

        return view('produit', [
            'produit' => $produit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $from_liste_id = $request->input('from_liste');

        try {
            DB::beginTransaction();
            //réalisation d'opérations sur la BDD.

            if ($request->has('action')) {
                $action = $request->input('action');

                if ($action === 'modifier_produit') {
                    $rules_produit = [
                        'nouveau_produit' => 'required|string|max:100',
                        'nouvelle_categorie' => 'nullable|string|max:100',
                    ];
                    $validated = $request->validate($rules_produit);
                    $produit->nom = $validated['nouveau_produit'];
                    $nom_categorie = $validated['nouvelle_categorie'];
                    $categorie = Categorie::where('nom', 'LIKE', $nom_categorie)->first();

                    if ($categorie) {
                        // La catégorie existe déjà
                        $categorie_id = $categorie->id;
                    } else {
                        // La catégorie n'existe pas et doit être créé.
                        $nouvelleCategorie = Categorie::create([
                            'nom' => $validated['nouvelle_categorie'],
                            'liste' => $from_liste_id,
                        ]);
                        info('la catégorie' . $nouvelleCategorie->nom . ' a été créée');
                        $categorie_id = $nouvelleCategorie->id;
                    }
                    $produit->categorie = $categorie_id;
                    $produit->save();
                    info('le produit ' . $produit->nom . ' a été modifié');

                } elseif ($action === 'supprimer_produit') {
                    Produit::where('nom', $produit->nom)->delete();
                    info('le produit ' . $produit->nom . ' a été supprimé');
                }
            }

            DB::commit();
            //toutes les opérations sur le BDD sont terminées.

            return redirect()->route('listes.show', ['liste' => $from_liste_id]);

        } catch (\Exception $e) {
            DB::rollBack();
            info("Une erreur s'est produite lors des opérations de base de données");
            return redirect()->route('listes.show', ['liste' => $from_liste_id]);
        }
    }

    public
    function suggestions(Request $request)
    {
        $query = $request->input('query'); // Récupérez la saisie de l'utilisateur
        $liste = $request->input('liste'); // Récupérez l'id de la liste
        $categories_eligibles = Categorie::where('liste', 'LIKE', $liste)->pluck('id')->toArray();
        $produits = Produit::where('nom', 'LIKE', "%$query%")->whereIn('categorie', $categories_eligibles)->get()->pluck('nom'); // Requête pour récupérer les suggestions
        return response()->json($produits); // Renvoyer les suggestions au format JSON
    }

    public
    function categorie(Request $request)
        //retourne le nom de la catégorie auquel appartient le produit dont le nom est entré en paramètre
    {
        $query = $request->input('query'); // Récupérez le nom du produit
        $produit = Produit::where('nom', 'LIKE', $query)->first(); // Requête pour récupérer le produit
        $categorie = Categorie::findOrFail($produit->categorie);
        return response()->json($categorie->nom); // Renvoyer le nom de la catégorie au format JSON
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
