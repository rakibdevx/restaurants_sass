<?php

namespace App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];
}
