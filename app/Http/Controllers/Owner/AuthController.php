<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OwnerResetPassword;
use App\Models\Owner\Owner;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('owner.auth.login');
    }

    // Login with full features
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the owner
        $owner = Owner::where('email', $request->email)->first();

        if (!$owner) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Check account status
        if ($owner->status !== 'active') {
            return back()->withErrors(['email' => 'Your account is ' . $owner->status]);
        }

        // Check lockout
        if ($owner->lockout_time && now()->lessThan($owner->lockout_time)) {
            $diff = $owner->lockout_time->diffForHumans();
            return back()->withErrors(['email' => "Account locked. Try again in $diff"]);
        }

        // Check password
        if (!Hash::check($request->password, $owner->password)) {
            $owner->failed_login_attempts += 1;

            // Lock account after 5 failed attempts
            if ($owner->failed_login_attempts >= 5) {
                $owner->lockout_time = now()->addMinutes(15);
                $owner->failed_login_attempts = 0;
            }

            $owner->save();

            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Successful login
        $owner->failed_login_attempts = 0;
        $owner->lockout_time = null;
        $owner->last_login_at = now();
        $owner->last_login_ip = $request->ip();
        $owner->save();

        // Two Factor check placeholder
        if ($owner->two_factor_enabled) {
            session(['2fa_owner_id' => $owner->id]);
            return redirect()->route('owner.2fa.verify');
        }

        Auth::guard('owner')->login($owner, $request->remember);
        $request->session()->regenerate();

        return redirect()->intended(route('owner.dashboard'));
    }

    // Show Registration Form
    public function showRegisterForm()
    {
        return view('owner.auth.register');
    }

    // Register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $owner = Owner::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('owner')->login($owner);

        return redirect()->route('owner.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('owner')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('owner.login');
    }

    // Show Forgot Password Form
    public function showForgotForm()
    {
        return view('owner.auth.forgot-password');
    }

    // Send Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:owners,email']);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        // Mail::to($request->email)->send(new OwnerResetPassword($token));

        return back()->with('status', 'Reset link sent to your email.');
    }

    // Show Reset Password Form
    public function showResetForm($token)
    {
        return view('owner.auth.reset-password', compact('token'));
    }

    // Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $reset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'Invalid token']);
        }

        $owner = Owner::where('email', $reset->email)->first();
        $owner->password = Hash::make($request->password);
        $owner->save();

        DB::table('password_resets')->where('email', $reset->email)->delete();

        return redirect()->route('owner.login')->with('status', 'Password reset successfully.');
    }
}
