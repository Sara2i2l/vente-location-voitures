<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Récupère uniquement les réservations du user connecté, triées par date de début
    $bookings = auth()->user()
                       ->bookings()
                       ->with('car')
                       ->orderBy('date_debut', 'desc')
                       ->paginate(10);

    return view('user.bookings.index', compact('bookings'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    // Si on passe ?car_id=xx dans l'URL, pré-sélectionne la voiture
    $selectedCarId = $request->query('car_id');

    // Récupère toutes les voitures disponibles à la location
    $cars = Car::where('type', 'location')
           ->where('disponible', true)
           ->get();

    return view('user.bookings.create', compact('cars', 'selectedCarId'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // 1. Validation (use your actual column names)
    $data = $request->validate([
        'car_id'      => 'required|exists:cars,id',
        'date_debut'  => 'required|date|after_or_equal:today',
        'date_fin'    => 'required|date|after:date_debut',
    ]);

    // 2. Fetch Car
    $car = \App\Models\Car::findOrFail($data['car_id']);

    // 3. Calculate days (+1 to include last day)
    $start = \Carbon\Carbon::parse($data['date_debut']);
    $end   = \Carbon\Carbon::parse($data['date_fin']);
    $days  = $start->diffInDays($end) + 1;

    // 4. Compute total price (prix in euros/MAD)
    $data['prix_total'] = $days * $car->prix;

    // 5. Attach user and status
    $data['user_id'] = auth()->id();
    $data['status']  = 'pending';

    // 6. Persist
    \App\Models\Booking::create($data);

    // 7. Redirect
    return redirect()
        ->route('user.bookings.index')
        ->with('success', "Réservation $days jour(s), total : " 
             . number_format($data['prix_total'],2,',',' ') . " MAD.");
}



    /**
     * Display the specified resource.
     *
     * @param  \App\AppModelsBooking  $appModelsBooking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
{
    // S’assure que le user ne peut voir que ses réservations
    $this->authorize('view', $booking);

    $booking->load('car');
    return view('user.bookings.show', compact('booking'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppModelsBooking  $appModelsBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
{
    $this->authorize('update', $booking);

    // Récupérer les voitures encore disponibles ou la voiture actuelle
    $cars = Car::where('type','location')
               ->where('disponible', true)
               ->orWhere('id', $booking->car_id)
               ->get();

    return view('user.bookings.edit', compact('booking','cars'));
}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppModelsBooking  $appModelsBooking
     * @return \Illuminate\Http\Response
     */
  
public function update(Request $request, Booking $booking)
{
    $this->authorize('update', $booking);

    $data = $request->validate([
        'car_id'     => 'required|exists:cars,id',
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin'   => 'required|date|after:date_debut',
    ]);

    $car = Car::findOrFail($data['car_id']);
    $start = \Carbon\Carbon::parse($data['date_debut']);
    $end   = \Carbon\Carbon::parse($data['date_fin']);
    $days  = $start->diffInDays($end) + 1;
    $data['prix_total'] = $days * $car->prix;

    $booking->update($data);

    return redirect()
        ->route('user.bookings.show', $booking)
        ->with('success', "Réservation mise à jour : $days jour(s), " . number_format($data['prix_total'],2,',',' ') . " MAD.");
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppModelsBooking  $appModelsBooking
     * @return \Illuminate\Http\Response
     */
    
public function destroy(Booking $booking)
{
    $this->authorize('delete', $booking);

    $booking->delete();

    return redirect()
        ->route('user.bookings.index')
        ->with('success', 'Réservation annulée avec succès.');
}

}
