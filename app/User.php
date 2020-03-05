<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'name', 'email', 'password'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function userInfo () {
        return $this->hasOne(User::class);
    }

    /**
     * @return HasMany
     */
    public function payments () {
        return $this->hasMany(Payment::class);
    }

    /**
     * @return HasMany
     */
    public function orders () {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function shippings () {
        return $this->hasMany(Shipping::class);
    }
}
