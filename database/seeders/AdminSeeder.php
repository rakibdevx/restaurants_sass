<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Admin\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '01700000000',

            'password' => Hash::make('password'),
            'avatar' => null,

            'status' => 'active',

            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),

            'last_login_at' => null,
            'last_login_ip' => null,

            'failed_login_attempts' => 0,
            'lockout_time' => null,

            'two_factor_enabled' => false,
            'two_factor_secret' => null,
            'two_factor_expires_at' => null,

            'last_password_change' => Carbon::now(),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
