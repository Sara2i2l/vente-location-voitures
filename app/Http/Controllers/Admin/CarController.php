<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // 1. liste des voitures pour l’admin
    public function index()
    {
        $cars = Car::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    // 2. formulaire de création
    public function create()
    {
        return view('admin.cars.create');
    }
}

