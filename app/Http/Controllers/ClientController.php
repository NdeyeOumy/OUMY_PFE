<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // public function update(Request $request, Client $client)
    // {
    //     $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //         'address' => 'required',
    //     ]);

    //     $client->update($request->all());
    //     return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    // }

    public function update(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
    ]);

    $client = Client::findOrFail($id);
    $client->update($request->all());

    return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès');
}
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
