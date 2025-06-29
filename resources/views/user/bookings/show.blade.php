@extends('layouts.app')
@section('title', "Réservation #{$booking->id}")
@section('content')
  <h1>Détail de la réservation</h1>
<ul class="list-group mb-3">
  <li class="list-group-item"><strong>Voiture :</strong> {{ $booking->car->marque }} {{ $booking->car->modele }}</li>
  <li class="list-group-item"><strong>Du :</strong> {{ $booking->date_debut }}</li>
  <li class="list-group-item"><strong>Au :</strong> {{ $booking->date_fin }}</li>
  <li class="list-group-item"><strong>Prix total :</strong> {{ number_format($booking->prix_total,2,',',' ') }} MAD</li>
  <li class="list-group-item"><strong>Status :</strong> {{ ucfirst($booking->status) }}</li>
</ul>

  <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary">Retour</a>
  <a href="{{ route('user.bookings.edit',$booking) }}" class="btn btn-warning">Modifier</a>
  <form action="{{ route('user.bookings.destroy',$booking) }}" method="POST" style="display:inline;">
    @csrf @method('DELETE')
    <button class="btn btn-danger" onclick="return confirm('Annuler cette réservation ?')">
      Annuler
    </button>
  </form>
@endsection

