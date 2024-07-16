<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DetailVente;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\Vente;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::all();
        return view('ventes.index', compact('ventes'));
    }

    public function create()
{
    $clients = Client::all(); // Remplacez par votre logique pour récupérer les clients
    $produits = Produit::all(); // Ajoutez également pour récupérer les produits si nécessaire

    return view('ventes.create', compact('clients', 'produits'));
}

    public function store(Request $request)
    {
        // Votre code pour le contrôleur de vente
        // Validation des données
        $request->validate([
            'idClients' => 'required|exists:clients,id',
            'date_vente' => 'required|date',
            'produits' => 'required|array',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        // Création de la vente
        $vente = Vente::create([
            'idClients' => $request->idClients,
            'date_vente' => $request->date_vente,
            'total' => $request->total,
        ]);

        // Création des détails de vente
        foreach ($request->produits as $produit) {
            $produitModel = Produit::find($produit['id']);
            $total = $produit['quantite'] * $produitModel->prix_unitaire;

            DetailVente::create([
                'idVente' => $vente->id,
                'idProduits' => $produit['id'],
                'quantite' => $produit['quantite'],
                'prix_unitaire' => $produitModel->prix_unitaire,
                'total' => $total,
            ]);
        }
        // Redirection ou réponse appropriée
        return redirect()->route('ventes.index')->with('success', 'La vente a été créée avec succès.');
   
    }
    public function show(Vente $vente)
    {
        return view('ventes.show', compact('vente'));
    }
    public function edit(Vente $vente)
    {
        return view('ventes.edit', compact('vente'));
    }
    
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'idClients' => 'required|exists:clients,id',
            'date_vente' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        // Recherche de la vente à mettre à jour
        $vente = Vente::findOrFail($id);

        // Mise à jour des données de la vente
        $vente->update([
            'idClients' => $request->idClients,
            'date_vente' => $request->date_vente,
            'total' => $request->total,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('ventes.index')->with('success', 'La vente a été mise à jour avec succès.');
    }

    public function destroy($id)
    {
        // Recherche de la vente à supprimer
        $vente = Vente::findOrFail($id);

        // Suppression de la vente et de ses détails
        $vente->details()->delete(); // Supprime les détails de vente liés
        $vente->delete(); // Supprime la vente elle-même

        // Redirection avec un message de succès
        return redirect()->route('ventes.index')->with('success', 'La vente a été supprimée avec succès.');
    }


    // Ajoutez d'autres méthodes selon vos besoins
}
