<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function roles() 
    {
        return $this->belongsToMany('App\Role', 'users_roles')->withTimestamps();
    }

    public function isSuperAdmin()
    {
        $user = Auth::user();
        if($user->roles->pluck('name')->first() == 'super_admin')
            return true;
    }

    public function isAdmin()
    {
        $user = Auth::user();
        if($user->roles->pluck('name')->first() == 'admin')
            return 'true';
    }

    public function isIdAdmin($id_user)
    {
        if($id_user->roles->pluck('name')->first() == 'admin')
            return true;
    }
}
