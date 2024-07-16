<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'idClients',
        'date_vente',
        'total',
    ];

    public function details()
    {
        return $this->hasMany(DetailVente::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'idClients');
    }

    // Dans le modèle Vente.php
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduits');
    }

}
