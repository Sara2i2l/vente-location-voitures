<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Vente/Location Voitures')</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="{{ url('/') }}">Voitures</a>
    <div class="ml-auto">
      <a href="{{ route('cars.index') }}" class="btn btn-outline-primary">Toutes les voitures</a>
      <a href="{{ route('cars.create') }}" class="btn btn-primary">Ajouter une voiture</a>
    </div>
  </nav>
  <div class="container">
    @yield('content')
  </div>
</body>
</html>

