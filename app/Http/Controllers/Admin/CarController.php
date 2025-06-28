<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Confirmation “delete” page
    public function delete(Car $car)
    {
        return view('admin.cars.delete', compact('car'));
    }

    // GET /admin/cars
    public function index()
    {
        $cars = Car::orderBy('created_at','desc')->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    // GET /admin/cars/create
    public function create()
    {
        return view('admin.cars.create');
    }

    // POST /admin/cars
    public function store(Request $request)
    {
        $data = $request->validate([
            'marque'     => 'required|string|max:255',
            'modele'     => 'required|string|max:255',
            'annee'      => 'required|integer|min:1900|max:'.date('Y'),
            'prix'       => 'required|numeric',
            'type'       => 'required|in:vente,location',
            'disponible' => 'nullable',
            'image'      => 'nullable|image|max:2048',
        ]);
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('cars','public');
        }
        $data['disponible'] = $request->has('disponible');
        $data['user_id']    = auth()->id();
        Car::create($data);
        return redirect()->route('admin.cars.index')
                         ->with('success','Voiture ajoutée.');
    }

    // GET /admin/cars/{car}
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    // GET /admin/cars/{car}/edit
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    // PUT/PATCH /admin/cars/{car}
    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'marque'     => 'required|string|max:255',
            'modele'     => 'required|string|max:255',
            'annee'      => 'required|integer|min:1900|max:'.date('Y'),
            'prix'       => 'required|numeric',
            'type'       => 'required|in:vente,location',
            'disponible' => 'nullable',
            'image'      => 'nullable|image|max:2048',
        ]);
        if($request->hasFile('image')){
            if($car->image){
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars','public');
        }
        $data['disponible'] = $request->has('disponible');
        $car->update($data);
        return redirect()->route('admin.cars.show',$car)
                         ->with('success','Voiture mise à jour.');
    }

    // DELETE /admin/cars/{car}
    public function destroy(Car $car)
    {
        if($car->image){
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();
        return redirect()->route('admin.cars.index')
                         ->with('success','Voiture supprimée.');
    }
}
