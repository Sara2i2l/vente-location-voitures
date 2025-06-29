@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
  <h1>Mes réservations</h1>

  @if($bookings->isEmpty())
    <p>Vous n'avez aucune réservation.</p>
  @else
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Voiture</th>
          <th>Du</th>
          <th>Au</th>
          <th>Prix total</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
  @foreach($bookings as $booking)
    <tr>
      <td>{{ $booking->id }}</td>
      <td>{{ $booking->car->marque }} {{ $booking->car->modele }}</td>
      <td>{{ $booking->date_debut }}</td>
      <td>{{ $booking->date_fin }}</td>
      <td>{{ number_format($booking->prix_total,2,',',' ') }} MAD</td>
      <td>{{ ucfirst($booking->status) }}</td>
      <td>
        <a href="{{ route('user.bookings.show', $booking) }}" class="btn btn-sm btn-info">Voir</a>
        <a href="{{ route('user.bookings.edit', $booking) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('user.bookings.destroy', $booking) }}" method="POST" style="display:inline;">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Annuler cette réservation ?')">Annuler</button>
        </form>
      </td>
    </tr>
  @endforeach
</tbody>

    </table>

    {{ $bookings->links() }}
  @endif
@endsection

