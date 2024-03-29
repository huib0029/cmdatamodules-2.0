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
    protected $fillable = ['sub', 'name', 'email', 'picture',  'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['sub',  'password', 'remember_token',];
    // taken worden opgeroepen van de task.php constructor/model
    public function tasks()
    {
            return $this->hasMany(Task::class, 'user_id');
    }
}
