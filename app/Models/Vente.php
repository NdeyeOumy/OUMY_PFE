<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'idClients',
        'idProduits',
        'quantite', 
        'prix_unitaire', 
        'total',
        'date_vente',  // Changer le nom de la colonne date_vente en date_achat pour la clé étrangère
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUsers');
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'idClients');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduits', 'id');
    }

    
}
