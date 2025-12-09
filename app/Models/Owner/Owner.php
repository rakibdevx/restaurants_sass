<?php

namespace App\Models\Owner;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $casts = [
        'lockout_time' => 'datetime',
        'last_login_at' => 'datetime',
    ];
}
