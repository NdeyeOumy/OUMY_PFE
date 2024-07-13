<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Vente;
use App\Models\Stock;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalProduits = Produit::count();
        $totalVentes = Vente::count();
        $totalRevenue = Vente::sum('total');
        // $totalStock = Stock::sum('quantite');
        $totalUsers = User::count();

        return view('dashboard.index', compact('totalClients', 'totalProduits', 'totalVentes', 'totalRevenue', 'totalUsers'));//'totalStock', 
    }
}
