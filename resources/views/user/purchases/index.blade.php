@extends('layouts.app')

@section('title', 'Mes achats')

@section('content')
  <h1>Mes achats</h1>

  @if($purchases->isEmpty())
    <p>Vous n'avez aucun achat.</p>
  @else
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Voiture</th>
          <th>Date d'achat</th>
          <th>Prix payé</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($purchases as $purchase)
          <tr>
            <td>{{ $purchase->id }}</td>
            <td>{{ $purchase->car->marque }} {{ $purchase->car->modele }}</td>
            <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
	    <!-- <td>{{ $purchase->date_achat }}</td> -->
            <td>{{ number_format($purchase->prix_achat,2,',',' ') }} MAD</td>
            <td>
              <a href="{{ route('user.purchases.show', $purchase) }}" class="btn btn-sm btn-info">Voir</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $purchases->links() }}
  @endif
@endsection

