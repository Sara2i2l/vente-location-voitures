@extends('layouts.app')

@section('title', 'Nouvelle réservation')

@section('content')
  <h1>Nouvelle réservation</h1>

  <form action="{{ route('user.bookings.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="car_id">Voiture</label>
      <select name="car_id" id="car_id" class="form-control" required>
        <option value="">-- Choisissez --</option>
        @foreach($cars as $car)
          <option value="{{ $car->id }}"
            {{ old('car_id', $selectedCarId) == $car->id ? 'selected' : '' }}>
            {{ $car->marque }} {{ $car->modele }} ({{ $car->year }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="date_debut">Date de début</label>
      <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
    </div>
    <div class="form-group">
      <label for="date_fin">Date de fin</label>
      <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Réserver</button>
  </form>
@endsection

