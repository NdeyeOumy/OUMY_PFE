@extends('layouts.main')

@section('title', "Gestion des produits")

@section('cssblock')
<!-- Datatables -->
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>GESTION DES PRODUITS</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-cubes"></i> PRODUITS </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <!-- Bouton Ajouter un Produit (Administrateur uniquement) -->
                        {{-- @if(Auth::user()->role == 'admin') --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal">
                                Ajouter un Produit
                            </button>
                        {{-- @endif --}}

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

                        <!-- Liste des Produits -->
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits as $produit)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                {{-- @if(Auth::user()->role == 'admin', 'gestionnaire') --}}
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i> 
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewProductModal{{ $produit->id }}">
                                                            <i class="fa fa-eye"></i> Voir détails
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editProductModal{{ $produit->id }}">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </a>
                                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                {{-- @else
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#viewProductModal{{ $produit->id }}">
                                                        <i class="fa fa-eye"></i> Voir détails
                                                    </button>
                                                @endif --}}
                                            </div>
                                        </td>
                                        <td>{{ $produit->id }}</td>
                                        <td>{{ $produit->name_pdt }}</td>
                                        <td>{{ $produit->description }}</td>
                                        <td>{{ $produit->prix }}</td>
                                        <td>{{ $produit->stock }}</td>
                                        <td>
                                            @if($produit->image)
                                                <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->name_pdt }}" style="width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal de visualisation de produit -->
                                    <div class="modal fade" id="viewProductModal{{ $produit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Détails du Produit</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>ID:</strong> {{ $produit->id }}</p>
                                                    <p><strong>Nom:</strong> {{ $produit->name_pdt }}</p>
                                                    <p><strong>Description:</strong> {{ $produit->description }}</p>
                                                    <p><strong>Prix:</strong> {{ $produit->prix }}</p>
                                                    <p><strong>Stock:</strong> {{ $produit->stock }}</p>
                                                    @if($produit->image)
                                                        <p><strong>Image:</strong></p>
                                                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->name_pdt }}" style="width: 100px; height: 100px;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal de modification de produit -->
                                    <div class="modal fade" id="editProductModal{{ $produit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Modifier le Produit</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulaire de Modification de Produit -->
                                                    <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <span class="section">Modifier le Produit</span>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 label-align">Nom<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input id="name_pdt" class="form-control" type="text" name="name_pdt" value="{{ $produit->name_pdt }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 label-align">Description<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <textarea id="description" class="form-control" name="description" required>{{ $produit->description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 label-align">Prix<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input id="prix" class="form-control" type="number" name="prix" value="{{ $produit->prix }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 label-align">Stock<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input id="stock" class="form-control" type="number" name="stock" value="{{ $produit->stock }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 label-align">Image</label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input id="image" class="form-control" type="file" name="image">
                                                                @if($produit->image)
                                                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->name_pdt }}" style="width: 100px; height: 100px; margin-top: 10px;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-primary">Modifier le Produit</button>
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

                        <!-- Modal d'ajout de produit -->
                        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Ajouter un Produit</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulaire d'Ajout de Produit -->
                                        <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <span class="section">Ajouter un Produit</span>
                                            <div class="field item form-group">
                                                <label class="control-label col-md-3 col-sm-3 label-align">Nom<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="name_pdt" class="form-control" type="text" name="name_pdt" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="control-label col-md-3 col-sm-3 label-align">Description<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <textarea id="description" class="form-control" name="description" required></textarea>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="control-label col-md-3 col-sm-3 label-align">Prix<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="prix" class="form-control" type="number" name="prix" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="control-label col-md-3 col-sm-3 label-align">Stock<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="stock" class="form-control" type="number" name="stock" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="control-label col-md-3 col-sm-3 label-align">Image</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="image" class="form-control" type="file" name="image">
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Ajouter le Produit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsblock')
<!-- Datatables -->
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> --}}
 <script> 
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endsection
