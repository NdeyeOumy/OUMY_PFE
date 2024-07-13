<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', Rule::in(['admin', 'gestionnaire'])],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'role' => $request->role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', Rule::in(['admin', 'gestionnaire'])],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => ['required','string','max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required','string', 'email','max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'role' => $request->role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('user.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
