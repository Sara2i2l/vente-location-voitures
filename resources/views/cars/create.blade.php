@extends('layouts.app')

@section('title', 'Ajouter une voiture')

@section('content')
  <h1>Ajouter une voiture</h1>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="form-group">
      <label>Marque</label>
      <input type="text" name="marque" class="form-control" value="{{ old('marque') }}" required>
    </div>
    <div class="form-group">
      <label>Modèle</label>
      <input type="text" name="modele" class="form-control" value="{{ old('modele') }}" required>
    </div>
    <div class="form-group">
      <label>Année</label>
      <input type="number" name="annee" class="form-control" value="{{ old('annee') }}" required>
    </div>
    <div class="form-group">
      <label>Prix (MAD)</label>
      <input type="text" name="prix" class="form-control" value="{{ old('prix') }}" required>
    </div>
    <div class="form-group">
      <label>Type</label>
      <select name="type" class="form-control" required>
        <option value="">-- Choisissez --</option>
        <option value="vente" {{ old('type') == 'vente' ? 'selected' : '' }}>Vente</option>
        <option value="location" {{ old('type') == 'location' ? 'selected' : '' }}>Location</option>
      </select>
    </div>
    <div class="form-group form-check">
      <input type="checkbox" name="disponible" class="form-check-input" id="disponible" {{ old('disponible') ? 'checked' : '' }}>
      <label class="form-check-label" for="disponible">Disponible</label>
    </div>
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="image" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </form>
@endsection
