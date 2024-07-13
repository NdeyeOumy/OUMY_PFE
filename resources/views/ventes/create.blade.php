@extends('layouts.main')

@section('title', 'Gestion des ventes')

@section('cssblock')
    <!-- Styles spécifiques pour cette vue -->
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>GESTION DES VENTES</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-shopping-cart"></i> AJOUTER UNE VENTE </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Settings 1</a>
                                        <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- Formulaire d'Ajout de Vente -->
                            <form action="{{ route('ventes.store') }}" method="POST">
                                @csrf
                                <span class="section">Ajouter une Vente</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Client<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control" name="idClients" required>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ CommonHelper::getFullName($client->first_name, $client->last_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Produit<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control" name="idProduits" required>
                                            @foreach($produits as $produit)
                                                <option value="{{ $produit->id }}">{{ $produit->name_pdt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Quantité<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="quantite" id="quantite" required oninput="calculateTotal()">
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Prix Unitaire<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" step="0.01" name="prix_unitaire" id="prix_unitaire" required oninput="calculateTotal()">
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Total<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" step="0.01" name="total" id="total" required readonly>
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Date de Vente<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="date" name="date_vente" required>
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregister </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsblock')
    <script>
        function calculateTotal() {
            var quantite = document.getElementById('quantite').value;
            var prix_unitaire = document.getElementById('prix_unitaire').value;
            var total = quantite * prix_unitaire;
            document.getElementById('total').value = total.toFixed(2);
        }
    </script>
@endsection
