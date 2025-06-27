<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Purchase;

class Car extends Model
{
   /**
     * Les attributs assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'marque',
        'modele',
        'annee',
        'prix',
        'type',
        'disponible',
        'image',
        'user_id',
    ];











 public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function purchases()
{
    return $this->hasMany(Purchase::class);
}

}
