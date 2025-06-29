<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    // Before hook: admins bypass everything
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function view(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }

    public function create(User $user)
    {
        return true; // any logged-in user can create
    }

    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }

    public function delete(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }
}

