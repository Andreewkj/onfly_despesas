<?php

namespace App\Policies;

use App\Models\Expenditure;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpenditurePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Expenditure $expenditure): bool
    {
        return $user->id == $expenditure->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Expenditure $expenditure): bool
    {
        return $user->id == $expenditure->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Expenditure $expenditure): bool
    {
        return $user->id == $expenditure->user_id;
    }
}
