<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idClients');
            $table->unsignedBigInteger('idProduits');
            $table->unsignedBigInteger('quantite');
            $table->unsignedBigInteger('prix_unitaire');
            $table->decimal('total');
            $table->date('date_vente');
            $table->timestamps();
            $table->foreign('idProduits')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('idClients')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
