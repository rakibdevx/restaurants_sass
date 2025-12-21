<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            // Basic Info
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();

            // Business Info
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('domain')->nullable();
            $table->string('theme')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('business_description')->nullable();

            // Login / Security
            $table->enum('status',['active','suspend','pending'])->default('active');
            $table->timestamp('expiry_time')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->integer('failed_login_attempts')->default(0);
            $table->timestamp('lockout_time')->nullable();
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->timestamp('two_factor_expires_at')->nullable();
            $table->timestamp('last_password_change')->nullable();

            // Payment Info
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('stripe_account_id')->nullable();
            $table->json('payment_settings')->nullable();

            // Indexes
            $table->index('status');
            $table->index('last_login_at');

            // Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
