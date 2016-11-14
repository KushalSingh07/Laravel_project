<?php

namespace App\Policies;

// use App\User;
// use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthUserPolicy
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

    public function auth_user($user, $article)
     {
            if($user->id == $article->user_id)
                return true;
     }

    public function auth_admin($user)
    {
        if($user->isAdmin())
            return true;
    }

    public function auth_id($user, $id_user)
    {
        if(isIdAdmin($id_user))
            return true;
    }
}
