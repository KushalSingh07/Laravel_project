<?php

namespace App\Policies;

use App\User;
use App\Article;
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

    // public function auth_user($user, $article)
    // {
    //     if($user->id == $article->user_id)
    //         return true;
    // }

    // public function auth_superAdmin($user)
    // {
    //     if($user->isSuperAdmin())
    //         return true;
    // }

    // public function auth_admin($user, $article)
    // {
    //     $article_role = $article->user->roles->pluck('name')->first();

    //     if($article_role == "super_admin")
    //     {
    //         return false;
    //     }

    //     if($user->isAdmin())
    //         return true;
    // }

    public function auth_superArticle($user, $article)
    {
        $user_role = $user->roles->pluck('name')->first();
        $article_role = $article->$user->roles->pluck('name')->first();
        if($user_role == $article_role){
            if($user_role == "super_admin"){
                return true;
            }
        }
    }

    public function auth_user($user, $article)
    {
        $article_role = $article->user->roles->pluck('name')->first();

        if($article_role == "super_admin")
        {
            return false;
        }

        if($user->id == $article->user_id)
            return true;

        if($user->isAdmin())
            return true;

        if($user->isSuperAdmin())
            return true;
    }
}
