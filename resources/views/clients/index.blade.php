@extends('layouts.main')

@section('title', "Gestion des clients")

@section('cssblock')
<!-- Datatables -->
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>GESTION DES CLIENTS</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-users"></i> CLIENTS </h2>
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
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clientModal">
                            Ajouter un Client
                        </button>

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

                        <!-- Liste des Clients -->
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Adresse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cog"></i> 
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewClientModal{{ $client->id }}">
                                                        <i class="fa fa-eye"></i> Voir détails
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editClientModal{{ $client->id }}">
                                                        <i class="fa fa-edit"></i> Modifier
                                                    </a>
                                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="fa fa-trash"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->first_name }}</td>
                                        <td>{{ $client->last_name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->address }}</td>
                                    </tr>
                                    <!-- Modal de visualisation de client -->
                                    <div class="modal fade" id="viewClientModal{{ $client->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Détails du Client</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>ID:</strong> {{ $client->id }}</p>
                                                    <p><strong>Nom:</strong> {{ $client->first_name }}</p>
                                                    <p><strong>Prénom:</strong> {{ $client->last_name }}</p>
                                                    <p><strong>Email:</strong> {{ $client->email }}</p>
                                                    <p><strong>Téléphone:</strong> {{ $client->phone }}</p>
                                                    <p><strong>Adresse:</strong> {{ $client->address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal de modification de client -->
                                    <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Modifier le Client</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulaire de Modification de Client -->
                                                    <form action="{{ route('clients.update', $client->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <span class="section">Modifier le Client</span>
                                                        <div class="field item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Nom<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" type="text" name="first_name" value="{{ $client->first_name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="field item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Prénom<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" type="text" name="last_name" value="{{ $client->last_name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="field item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Email<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" type="email" name="email" value="{{ $client->email }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="field item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Téléphone<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" type="text" name="phone" value="{{ $client->phone }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="field item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Adresse<span class="required">*</span></label>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" type="text" name="address" value="{{ $client->address }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-6 offset-md-3">
                                                                <button type='submit' class="btn btn-primary">Enregistrer les Modifications</button>
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

<!-- Modal pour ajouter un client -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ajouter un Client</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout de client -->
                <div class="tab-content">
                    <!-- Formulaire de Client -->
                    <div class="">
                        <div class="row ">
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <form action="{{ route('clients.store') }}" method="POST" >
                                            @csrf
                                            <span class="section">Données du Client</span>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Nom<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="text" name="first_name" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Prénom<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="text" name="last_name" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="email" name="email" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Téléphone<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="text" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Adresse<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="text" name="address" required>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' class="btn btn-primary">Enregistrer</button>
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
<!-- Ajoutez ici les fichiers JS supplémentaires si nécessaire -->
@endsection
