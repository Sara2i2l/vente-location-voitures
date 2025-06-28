@extends('layouts.app')

@section('title', 'Supprimer la voiture')

@section('content')
  <h1>Supprimer la voiture #{{ $car->id }}</h1>
  <p>Marque : {{ $car->marque }}, Modèle : {{ $car->modele }}</p>

  <form action="{{ route('admin.cars.destroy', $car) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">Oui, supprimer</button>
    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Annuler</a>
  </form>
@endsection

