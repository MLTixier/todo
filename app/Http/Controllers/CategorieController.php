<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Categorie::All()->sortBy('liste');

        return view('categories', [
            'categories' => $categories,
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {

        $categorie = Categorie::findOrFail($id);
        return view('categorie', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $categorie = Categorie::findOrFail($id);

        try {
            DB::beginTransaction();
            //réalisation d'opérations sur la BDD.

            if ($request->has('action')) {
                $action = $request->input('action');

                if ($action === 'modifier_categorie') {
                    $rules_produit = [
                        'categorie' => 'nullable|string|max:100',
                        'liste_categorie' => 'nullable|int',
                    ];
                    $validated = $request->validate($rules_produit);
                    $nom_categorie = $validated['categorie'];
                    $liste_categorie = $validated['liste_categorie'];
                    $categorie->nom = $nom_categorie;
                    $categorie->liste = $liste_categorie;
                    $categorie->save();
                    info('la catégorie ' . $categorie->nom . ' a été modifiée');

                } elseif ($action === 'supprimer_categorie') {
                    Categorie::where('nom', $categorie->nom)->delete();
                    info('la catégorie ' . $categorie->nom . ' a été supprimée');
                }
            }

            DB::commit();
            //toutes les opérations sur le BDD sont terminées.

            return redirect()->route('categories.index');

        } catch (\Exception $e) {
            DB::rollBack();
            info("Une erreur s'est produite lors des opérations de base de données");
            info($e);
            return redirect()->route('categories.index');
        }
    }

    public function suggestions(Request $request)
    {
        $query = $request->input('query'); // Récupérez la saisie de l'utilisateur
        $liste = $request->input('liste'); // Récupérez l'id de la liste'
        $categories = Categorie::where('nom', 'LIKE', "%$query%")->where('liste', 'LIKE', $liste)->pluck('nom'); // Requête pour récupérer les suggestions
        return response()->json($categories); // Renvoyer les suggestions au format JSON
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
