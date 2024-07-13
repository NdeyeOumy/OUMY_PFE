{{-- @extends('layouts.main')

@section('content')
<div class="container">
    <h1>MODIFIER PRODUITS</h1>

    @include('produits.form')
</div>

@endsection

<form action="{{ route('produits.update', $produit->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name_pdt">Nom:</label>
        <input type="text" name="name_pdt" value="{{ $produit->name_pdt }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="designation">Designation:</label>
        <textarea name="designation" class="form-control" required>{{ $produit->designation }}</textarea>
    </div>
    <div class="form-group">
        <label for="prix">Prix:</label>
        <input type="number" name="prix" value="{{ $produit->prix }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ $produit->stock }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">MODIFIER</button>
</form>

@endsection --}}
