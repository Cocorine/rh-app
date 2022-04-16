<?php

namespace App\Policies;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaiementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Paiement $paiement)
    {
        return true;
        //optional($user)->isAdmin() || optional($user)->isComptable() || optional(optional(optional($user)->poste_users)->last())->id === $paiement->poste_user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return optional($user)->can('manage-payments') || optional($user)->can('create-payments');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function validate(User $user, Paiement $paiement)
    {
        return optional(optional(optional($user)->poste_users)->last())->id === $paiement->poste_user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Paiement $paiement)
    {
        return optional($user)->can('manage-payments') || optional($user)->can('update-payments');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Paiement $paiement)
    {
        return optional($user)->can('manage-payments') || optional($user)->can('delete-payments');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Paiement $paiement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Paiement $paiement)
    {
        //
    }
}
