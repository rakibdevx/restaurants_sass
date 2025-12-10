<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Login with full features
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the admin
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Check account status
        if ($admin->status !== 'active') {
            return back()->withErrors(['email' => 'Your account is ' . $admin->status]);
        }

        // Check lockout
        if ($admin->lockout_time && now()->lessThan($admin->lockout_time)) {
            $diff = $admin->lockout_time->diffForHumans();
            return back()->withErrors(['email' => "Account locked. Try again in $diff"]);
        }

        // Check password
        if (!Hash::check($request->password, $admin->password)) {
            $admin->failed_login_attempts += 1;

            // Lock account after 5 failed attempts
            if ($admin->failed_login_attempts >= 5) {
                $admin->lockout_time = now()->addMinutes(15);
                $admin->failed_login_attempts = 0;
            }

            $admin->save();

            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Successful login
        $admin->failed_login_attempts = 0;
        $admin->lockout_time = null;
        $admin->last_login_at = now();
        $admin->last_login_ip = $request->ip();
        $admin->save();

        // Two Factor check placeholder
        if ($admin->two_factor_enabled) {
            session(['2fa_admin_id' => $admin->id]);
            return redirect()->route('admin.2fa.verify');
        }

        Auth::guard('admin')->login($admin, $request->remember);
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }


}

