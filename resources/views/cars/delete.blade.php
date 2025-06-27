@extends('layouts.app')

@section('title', 'Supprimer la voiture')

@section('content')
  <h1>Supprimer la voiture</h1>

  <div class="alert alert-warning">
    <p>Êtes-vous sûr·e de vouloir supprimer définitivement cette voiture ?</p>
  </div>

  <div class="card mb-4">
    @if($car->image)
      <img src="{{ asset('storage/'.$car->image) }}" class="card-img-top" alt="Image">
    @endif
    <div class="card-body">
      <h5 class="card-title">{{ $car->marque }} {{ $car->modele }} ({{ $car->annee }})</h5>
      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item"><strong>Prix :</strong> {{ number_format($car->prix,2,',',' ') }} MAD</li>
        <li class="list-group-item"><strong>Type :</strong> {{ ucfirst($car->type) }}</li>
        <li class="list-group-item"><strong>Disponible :</strong> {{ $car->disponible ? 'Oui' : 'Non' }}</li>
      </ul>

      <form action="{{ route('cars.destroy', $car) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Annuler</a>
      </form>
    </div>
  </div>
@endsection

