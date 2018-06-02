<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*-------------------------------*\
        Relationships
    \*-------------------------------*/

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * check if user is active and an administrator
     * @return bool
     */

    public function isAdmin()
    {
        return ($this->role->name == 'administrator' && $this->is_active == 1) ? true : false;
    }

    /**
     * Delete user photo if exists then delete the user
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        if($this->photo)
        {
            $this->photo->delete();
        }
        return parent::delete();
    }

}
