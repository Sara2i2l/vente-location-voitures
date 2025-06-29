@extends('layouts.app')
@section('title', "Achat #{$purchase->id}")
@section('content')
  <h1>Détail de l'achat</h1>
  <ul class="list-group">
    <li class="list-group-item"><strong>Voiture :</strong> {{ $purchase->car->marque }} {{ $purchase->car->modele }}</li>
    <li class="list-group-item"><strong>Date d'achat :</strong> {{ $purchase->date_achat }}</li>
    <li class="list-group-item"><strong>Prix payé :</strong> {{ number_format($purchase->prix_achat,2,',',' ') }} MAD</li>
  </ul>
  <a href="{{ route('user.purchases.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection

