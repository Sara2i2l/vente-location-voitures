@extends('layouts.app')

@section('title', "Détail de la voiture {$car->marque} {$car->modele}")

@section('content')
  <h1>Détail de la voiture</h1>

  <div class="card mb-4">
    @if($car->image)
      <img src="{{ asset('storage/'.$car->image) }}" class="card-img-top" alt="Image">
    @endif
    <div class="card-body">
      <h5 class="card-title">{{ $car->marque }} {{ $car->modele }}</h5>
      <ul class="list-group list-group-flush mb-3">
        <!-- <li class="list-group-item"><strong>ID :</strong> {{ $car->id }}</li> -->
        <li class="list-group-item"><strong>Année :</strong> {{ $car->annee }}</li>
        <li class="list-group-item"><strong>Prix :</strong> {{ number_format($car->prix,2,',',' ') }} MAD</li>
        <li class="list-group-item"><strong>Type :</strong> {{ ucfirst($car->type) }}</li>
        <li class="list-group-item"><strong>Disponible :</strong> {{ $car->disponible ? 'Oui' : 'Non' }}</li>
      </ul>
    	<div class="d-flex justify-content-between mb-3">
  <a href="{{ route('cars.index') }}" class="btn btn-secondary">Retour</a>

  <div>
    @auth
      @if(! auth()->user()->is_admin && $car->type === 'location' && $car->disponible)
        <a href="{{ route('user.bookings.create', ['car_id' => $car->id]) }}"
           class="btn btn-success">
          Réserver cette voiture
        </a>
      @endif

      @if(! auth()->user()->is_admin && $car->type === 'vente' && $car->disponible)
        <a href="{{ route('user.purchases.create', ['car_id' => $car->id]) }}"
           class="btn btn-warning ml-2">
          Acheter cette voiture
        </a>
      @endif
    @endauth
  </div>
</div>

    </div>
  </div>
@endsection

