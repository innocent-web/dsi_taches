<?php

namespace App\Policies;

use App\User;
use App\Tache;
use Illuminate\Auth\Access\HandlesAuthorization;

class TachePolicy
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

    public function delete(User $user, Tache $tache){
        return $user->id === $tache->creator_id;
    }

    public function edit(User $user, Tache $tache){
        return $user->id === $tache->creator_id;
    }
}
