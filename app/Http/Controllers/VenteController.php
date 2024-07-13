<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::all();
        $clients = Client::all();
        $produits = Produit::all(); // Ajoutez cette ligne pour récupérer tous les produits

        return view('ventes.index', compact('ventes', 'clients', 'produits'));
    }

    public function create()
{
    $clients = Client::all();
    $produits = Produit::all(); // Ajoutez cette ligne pour récupérer tous les produits

    return view('ventes.create', compact('clients', 'produits'));
}


    public function store(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'idClients' => 'required|exists:clients,id',
            'idProduits' => 'required|exists:produits,id',
            'quantite' => 'required|numeric',
            'prix_unitaire' => 'required|numeric',
            'total' => 'required|numeric',
            'date_vente' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('ventes.index')->withErrors($validator)->withInput();
        }

        $data_request = $request->all();
        $data_request['idUser'] = Auth::id();

        if (Vente::create($data_request)) {
            return redirect()->route('ventes.index')->with('success', 'Vente créée avec succès.');
        }

        return redirect()->route('ventes.index')->with('error', 'Échec de la création de la vente.');
    }

    public function edit(Vente $vente)
    {
        $clients = Client::all();
        return view('ventes.edit', compact('vente', 'clients'));
    }

    public function update(Request $request, Vente $vente)
    {
        $validator = Validator::make($request->all(), [
            'idClients' => 'required|exists:clients,id',
            'idProduit' => 'required|exists:products,id',
            'quantite' => 'required|numeric',
            'prix_unitaire' => 'required|numeric',
            'total' => 'required|numeric',
            'date_vente' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('ventes.index')->withErrors($validator)->withInput();
        }

        $vente->update($request->all());

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
    }

    public function show($id)
    {
        $vente = Vente::findOrFail($id);
        return view('ventes.show', compact('vente'));
    }

    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }
}
