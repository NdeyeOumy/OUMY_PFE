<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_pdt' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $produit = new Produit($request->all());

        if ($request->hasFile('image')) {
            $produit->image = $request->file('image')->store('produits', 'public');
        }

        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_pdt' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->fill($request->all());

        if ($request->hasFile('image')) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $produit->image = $request->file('image')->store('produits', 'public');
        }

        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
