<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthArticlePolicy
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
}
