@extends('layouts.app')

@section('title', 'Nouvel achat')

@section('content')
  <h1>Nouvel achat</h1>

  <form action="{{ route('user.purchases.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="car_id">Voiture</label>
      <select name="car_id" id="car_id" class="form-control" required>
        <option value="">-- Choisissez --</option>
        @foreach($cars as $car)
          <option value="{{ $car->id }}"
            {{ old('car_id', $selectedCarId) == $car->id ? 'selected' : '' }}>
            {{ $car->marque }} {{ $car->modele }} ({{ $car->prix }} MAD)
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Acheter</button>
  </form>
@endsection

