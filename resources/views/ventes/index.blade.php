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
                            <h2><i class="fa fa-shopping-cart"></i> VENTES </h2>
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
                            <!-- Lien vers la page de création -->
                            <a href="{{ route('ventes.create') }}" class="btn btn-primary">
                                Ajouter une Vente
                            </a>

                            <br><br>

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success mt-3">
                                    {{ $message }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Liste des Ventes -->
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Prix Unitaire</th>
                                        <th>Total</th>
                                        <th>Date de Vente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ventes as $vente)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewventeModal{{ $vente->id }}">
                                                            <i class="fa fa-eye"></i> Voir détails
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editventeModal{{ $vente->id }}">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </a>
                                                        <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $vente->id }}</td>
                                            <td>{{ $vente->client->first_name }} {{ $vente->client->last_name }}</td>
                                            <td>{{ $vente->produit->name_pdt }}</td>
                                            <td>{{ $vente->quantite }}</td>
                                            <td>{{ $vente->prix_unitaire }}</td>
                                            <td>{{ $vente->total }}</td>
                                            <td>{{ $vente->date_vente }}</td>
                                        </tr>
                                        {{-- <!-- Modals -->
                                        @include('modals.viewvente')
                                        @include('modals.editvente') --}}
                                        <!-- Modal de visualisation de vente -->
                                        <div class="modal fade" id="viewventeModal{{ $vente->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Détails de la Vente</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>ID:</strong> {{ $vente->id }}</p>
                                                        <p><strong>Client:</strong> {{ CommonHelper::getFullName($vente->first_name, $vente->last_name) }}</p>
                                                        <p><strong>Produit:</strong> {{ $vente->produit->name_pdt }}</p>
                                                        <p><strong>Quantité:</strong> {{ $vente->quantite }}</p>
                                                        <p><strong>Prix Unitaire:</strong> {{ $vente->prix_unitaire }}</p>
                                                        <p><strong>Total:</strong> {{ $vente->total }}</p>
                                                        <p><strong>Date de Vente:</strong> {{ $vente->date_vente }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal de modification de vente -->
                                        <div class="modal fade" id="editventeModal{{ $vente->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Modifier la Vente</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Formulaire de Modification de Vente -->
                                                        <form action="{{ route('ventes.update', $vente->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <span class="section">Modifier la Vente</span>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Client<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <select class="form-control" name="idClients" required>
                                                                        <option value="" selected disabled>Sélectionner un client</option>
                                                                        @foreach($clients as $client)
                                                                            <option value="{{ $client->id }}" {{ $vente->idClients == $client->id ? 'selected' : '' }}>
                                                                                {{ CommonHelper::getFullName($client->first_name, $client->last_name) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Produit<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <select class="form-control" name="idProduits{{ $vente->id }}" required >
                                                                        @foreach($produits as $produit)
                                                                            <option value="{{ $produit->id }}" {{ $vente->idProduits == $produit->id ? 'selected' : '' }}>{{ $produit->name_pdt }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Quantité<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="number" name="quantite" data-id="{{ $vente->id }}" value="{{ $vente->quantite }}" required oninput="calculateEditTotal({{ $vente->id }})">
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Prix Unitaire<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="number" step="0.01" name="prix_unitaire" data-id="{{ $vente->id }}" value="{{ $vente->prix_unitaire }}" required oninput="calculateEditTotal({{ $vente->id }})">
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Total<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="number" step="0.01" name="total" id="total{{ $vente->id }}" value="{{ $vente->total }}" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Date de Vente<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="date" name="date_vente" value="{{ $vente->date_vente }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary">Modifier la Vente</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('jsblock')
    <script>
        function calculateEditTotal(id) {
            var quantite = document.querySelector(`input[name="quantite"][data-id="${id}"]`).value;
            var prix_unitaire = document.querySelector(`input[name="prix_unitaire"][data-id="${id}"]`).value;
            var total = quantite * prix_unitaire;
            document.getElementById(`total${id}`).value = total.toFixed(2);
        }
    </script>
@endsection
