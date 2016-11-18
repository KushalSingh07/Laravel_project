<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthCheckRolePolicy
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

    public function auth_id($user, $id_user)
    {
        if($id_user->roles->pluck('name')->first() == 'admin')
            return true;
    }

    public function auth_idSuper($user, $id_user)
    {
        if($id_user->roles->pluck('name')->first() == 'super_admin')
            return true;
    }
}
