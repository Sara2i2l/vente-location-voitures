@extends('layouts.app')

@section('title', "Modifier la voiture {$car->marque} {$car->modele}")

@section('content')
  <h1>Modifier la voiture</h1>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Marque</label>
      <input type="text" name="marque" class="form-control" 
             value="{{ old('marque', $car->marque) }}" required>
    </div>
    <div class="form-group">
      <label>Modèle</label>
      <input type="text" name="modele" class="form-control" 
             value="{{ old('modele', $car->modele) }}" required>
    </div>
    <div class="form-group">
      <label>Année</label>
      <input type="number" name="annee" class="form-control" 
             value="{{ old('annee', $car->annee) }}" required>
    </div>
    <div class="form-group">
      <label>Prix (MAD)</label>
      <input type="text" name="prix" class="form-control" 
             value="{{ old('prix', $car->prix) }}" required>
    </div>
    <div class="form-group">
      <label>Type</label>
      <select name="type" class="form-control" required>
        <option value="vente" {{ old('type', $car->type) == 'vente' ? 'selected' : '' }}>Vente</option>
        <option value="location" {{ old('type', $car->type) == 'location' ? 'selected' : '' }}>Location</option>
      </select>
    </div>
    <div class="form-group form-check">
      <input type="checkbox" name="disponible" class="form-check-input" id="disponible"
             {{ old('disponible', $car->disponible) ? 'checked' : '' }}>
      <label class="form-check-label" for="disponible">Disponible</label>
    </div>
    <div class="form-group">
      <label>Image actuelle</label><br>
      @if($car->image)
        <img src="{{ asset('storage/'.$car->image) }}" alt="Image" width="150">
      @else
        <span>Aucune</span>
      @endif
    </div>
    <div class="form-group">
      <label>Changer d’image</label>
      <input type="file" name="image" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-success">Mettre à jour</button>
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Annuler</a>
  </form>
@endsection

