<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    /**
     * @return mixed
     */
    public function authors()
    {
        return $this->hasMany('App\Models\Author');
    }

    /**
     * @return mixed
     */
    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    /**
     * @return mixed
     */
    public function publishers()
    {
        return $this->hasMany('App\Models\Publisher');
    }

     /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
