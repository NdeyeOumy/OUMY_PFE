<?php

use App\Http\Controllers\Controller;
use App\Models\DetailVente;
use App\Models\Vente;
use App\Models\VenteDetail;
use App\Models\Produit;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function store(Request $request)
    {
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
}
