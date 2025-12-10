<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Owner\Owner;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        Owner::create([
            'name' => 'Test Owner',
            'username' => 'owner123',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),

            'phone' => '01700000000',
            'profile_image' => null,

            'company_name' => 'Test Company',
            'company_logo' => null,

            'slug' => 'test-owner',
            'domain' => 'test.com',
            'theme' => 'default',

            'address' => 'Dhaka, Bangladesh',
            'city' => 'Dhaka',
            'state' => 'Dhaka',
            'country' => 'Bangladesh',
            'postal_code' => '1200',

            'business_description' => 'This is a test business.',

            'status' => 'active',

            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),

            'last_login_at' => null,
            'last_login_ip' => null,

            'failed_login_attempts' => 0,
            'lockout_time' => null,

            'two_factor_enabled' => 0,
            'two_factor_secret' => null,
            'two_factor_expires_at' => null,

            'last_password_change' => Carbon::now(),

            'bank_name' => 'Test Bank',
            'bank_account_number' => '1234567890',
            'bank_ifsc' => 'IFSC001',

            'paypal_email' => 'paypal@test.com',
            'stripe_account_id' => 'acct_test123',

            'payment_settings' => json_encode([
                'paypal' => true,
                'stripe' => true,
                'bank_transfer' => true
            ]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
