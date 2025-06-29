<?php

namespace App\Http\Controllers\User;

use App\AppModelsPurchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Récupérer les achats du user connecté, avec la voiture
    $purchases = auth()->user()
                  ->purchases()
                  ->with('car')
                  ->orderBy('date_achat', 'desc')
                  ->paginate(10);


    return view('user.purchases.index', compact('purchases'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    // Pré‑sélection via query ?car_id=xx
    $selectedCarId = $request->query('car_id');

    // Récupérer les voitures en vente et disponibles
    $cars = \App\Models\Car::where('type', 'vente')
                           ->where('disponible', true)
                           ->get();

    return view('user.purchases.create', compact('cars', 'selectedCarId'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'car_id' => 'required|exists:cars,id',
    ]);

    $car = Car::findOrFail($data['car_id']);
    if ($car->type !== 'vente' || ! $car->disponible) {
        return back()->withErrors('Cette voiture n’est pas disponible à la vente.');
    }

    $data['user_id']   = auth()->id();
    $data['prix_achat']= $car->prix;
    $data['date_achat'] = Carbon::now()->toDateString();

    Purchase::create($data);

    return redirect()
        ->route('user.purchases.index')
        ->with('success',
            "Achat réalisé le " . now()->format('Y-m-d') .
            " pour " . number_format($data['prix_achat'],2,',',' ') . " MAD."
        );
}

    /**
     * Display the specified resource.
     *
     * @param  \App\AppModelsPurchase  $appModelsPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Purchase $purchase)
{
    $this->authorize('view', $purchase); // optionnel si tu utilises une policy
    $purchase->load('car');
    return view('user.purchases.show', compact('purchase'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppModelsPurchase  $appModelsPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(AppModelsPurchase $appModelsPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppModelsPurchase  $appModelsPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppModelsPurchase $appModelsPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppModelsPurchase  $appModelsPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppModelsPurchase $appModelsPurchase)
    {
        //
    }
}
