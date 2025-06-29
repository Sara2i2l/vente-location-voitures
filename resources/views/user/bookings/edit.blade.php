@extends('layouts.app')
@section('title', "Modifier Réservation #{$booking->id}")
@section('content')
  <h1>Modifier la réservation</h1>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ route('user.bookings.update', $booking) }}" method="POST">
    @csrf @method('PUT')

    <div class="form-group">
      <label>Voiture</label>
      <select name="car_id" class="form-control" required>
        @foreach($cars as $car)
          <option value="{{ $car->id }}"
            {{ old('car_id', $booking->car_id) == $car->id ? 'selected' : '' }}>
            {{ $car->marque }} {{ $car->modele }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Date de début</label>
      <input type="date" name="date_debut" class="form-control"
             value="{{ old('date_debut', $booking->date_debut) }}" required>
    </div>
    <div class="form-group">
      <label>Date de fin</label>
      <input type="date" name="date_fin" class="form-control"
             value="{{ old('date_fin', $booking->date_fin) }}" required>
    </div>

    <button class="btn btn-success">Mettre à jour</button>
    <a href="{{ route('user.bookings.show', $booking) }}" class="btn btn-secondary">Annuler</a>
  </form>
@endsection

