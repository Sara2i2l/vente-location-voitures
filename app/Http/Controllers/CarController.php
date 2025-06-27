<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// 1. Affiche la liste des voitures 
   public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
// 2. Affiche le formulaire de création
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'marque'     => 'required|string|max:255',
        'modele'     => 'required|string|max:255',
        'annee'      => 'required|integer|min:1900|max:' . date('Y'),
        'prix'       => 'required|numeric',
        'type'       => 'required|in:vente,location',
        'disponible' => 'nullable',
        'image'      => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('cars', 'public');
    }

    // transforme la checkbox en booléen
    $validated['disponible'] = $request->has('disponible');

    // si on rattache un user (user_id = 1 par défaut)
    $validated['user_id'] = auth()->id() ?? 1;

    Car::create($validated);

    return redirect()
        ->route('cars.index')
        ->with('success', 'Voiture ajoutée avec succès.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
{
    return view('cars.show', compact('car'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
 * Show the form for editing the specified resource.
 */
public function edit(Car $car)
{
    return view('cars.edit', compact('car'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
{
    $validated = $request->validate([
        'marque'     => 'required|string|max:255',
        'modele'     => 'required|string|max:255',
        'annee'      => 'required|integer|min:1900|max:' . date('Y'),
        'prix'       => 'required|numeric',
        'type'       => 'required|in:vente,location',
        'disponible' => 'nullable',
        'image'      => 'nullable|image|max:2048',
    ]);

    // Gérer le nouvel upload d’image
    if ($request->hasFile('image')) {
        // supprimer l’ancienne si existe
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $validated['image'] = $request->file('image')->store('cars', 'public');
    }

    $validated['disponible'] = $request->has('disponible');

    $car->update($validated);

    return redirect()
        ->route('cars.show', $car)
        ->with('success', 'Voiture mise à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Car $car)
{
    return view('cars.delete', compact('car'));
}

public function destroy($id)
{
    $car = Car::findOrFail($id);

    // Supprimer l'image du stockage si présente
    if ($car->image) {
        Storage::disk('public')->delete($car->image);
    }

    $car->delete();

    return redirect()
        ->route('cars.index')
        ->with('success', 'Voiture supprimée avec succès.');
}


}
