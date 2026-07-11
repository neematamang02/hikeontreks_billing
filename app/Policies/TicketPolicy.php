<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;



class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function editTicketPayment(User $user, $model = null)
    {
        return $user->role === 'admin';
    }
    public function edit(User $user, $model = null)
    {
        return $user->role === 'admin';
    }
    public function updateTicketPayment(User $user, $model = null)
    {
        return $user->role === 'admin';
    }
}


