@extends('layouts.app')

@section('title', 'Liste des voitures')

@section('content')
  <h1>Liste des voitures</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Année</th>
        <th>Prix</th>
        <th>En vente</th>
        <th>En location</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
  @foreach($cars as $index => $car)
    <tr>
      <!-- Afficher un compteur de ligne plutôt que l'id brut -->
      <td>{{ $index + 1 }}</td>

      <!-- Colonnes alignées sur tes attributs réels -->
      <td>{{ $car->marque }}</td>
      <td>{{ $car->modele }}</td>
      <td>{{ $car->annee }}</td>
      <td>{{ number_format($car->prix, 2, ',', ' ') }} MAD</td>

      <!-- Utiliser le champ 'type' -->
      <td>{{ $car->type === 'vente' ? 'Oui' : 'Non' }}</td>
      <td>{{ $car->type === 'location' ? 'Oui' : 'Non' }}</td>

      <td>
        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">Voir</a>
        


      </td>
    </tr>
  @endforeach
</tbody>

  </table>
@endsection

