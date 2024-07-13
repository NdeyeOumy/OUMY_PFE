@extends('layouts.main')

@section('title', "Gestion des utilisateurs")

@section('cssblock')

@endsection

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>GESTION DES UTILISATEURS</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-users"></i> UTILISATEURS </h2>
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
                        @if(Auth::user()->role == 'gestionnaire')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">
                                Ajouter un Utilisateur
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

                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>ID</th>
                                        <th>Role</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewUserModal{{ $user->id }}">
                                                            <i class="fa fa-eye"></i> Voir détails
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </a>
                                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->first_name }}</td>
                                             <td>{{ $user->last_name }}</td>
                                             <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>

                                        <!-- Modal de visualisation de l'utilisateur -->
                                        <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Détails de l'utilisateur</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>ID:</strong> {{ $user->id }}</p>
                                                        <p><strong>Role:</strong> {{ $user->role }}</p>
                                                        <p><strong>Prénom:</strong> {{ $user->first_name }}</p>
                                                        <p><strong>Nom:</strong> {{ $user->last_name }}</p>
                                                        <p><strong>Username:</strong> {{ $user->username }}</p>
                                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal de modification de l'utilisateur -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Modifier l'utilisateur</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <span class="section">Modifier l'utilisateur</span>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Rôle<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <select class="form-control" name="role" required>
                                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                                                        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Gestionnaire</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Prénom<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Nom<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Username<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="text" name="username" value="{{ $user->username }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email<span class="required">*</span></label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="field item form-group">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Mot de passe</label>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <input class="form-control" type="password" name="password">
                                                                    <small>Laissez vide si vous ne souhaitez pas modifier le mot de passe.</small>
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
                        @else
                            <div class="alert alert-danger">
                                Vous n'avez pas l'autorisation d'accéder à cette page.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter un utilisateur -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">   
        <div class="modal-content">            
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ajouter un Utilisateur</h4>                                                   
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout d'utilisateur -->
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <span class="section">Ajouter un Utilisateur</span>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Rôle<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" name="role" required>
                                <option value="admin">Administrateur</option>
                                <option value="manager">Gestionnaire</option>
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Prénom<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" name="first_name" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Nom<span class="required">*</span></label>
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
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Mot de passe<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Confirmer le mot de passe<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='submit' class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsblock')
{{-- <script type="text/javascript">
    setTimeout(function() {
        window.location.href = "{{ route('bo.login.auth') }}";
    }, 1000); // Redirige après 3 secondes
</script> --}}
@endsection
