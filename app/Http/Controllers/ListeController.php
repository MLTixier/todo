<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use App\Models\Produit;
use Illuminate\Http\Request;

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
        $produits = $liste->produits;
        return view('liste', [
            'liste' => $liste,
            'produits' => $produits,
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
        if ($request->has('action')) {
            $action = $request->input('action');

            if ($action === 'vider_la_liste') {
                foreach ($produits as $produit) {
                    $liste->produits()->detach($produit->id);
                }

            } elseif ($action === 'sauvegarder') {
                foreach ($produits as $produit) {
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

            } elseif (substr($action, 0, 18) === 'supprimer_produit_') {
                $produit_id_a_supprimer = substr($action, 18);
                $liste->produits()->detach($produit_id_a_supprimer);
            }
        }
        return back();
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
