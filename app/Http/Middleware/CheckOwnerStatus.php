<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckOwnerStatus
{
    public function handle(Request $request, Closure $next)
    {
        $owner = Auth::guard('owner')->user();

        if ($owner && $owner->status !== 'active') {
            Auth::guard('owner')->logout();
            return redirect()->route('owner.login')
                ->withErrors(['email' => 'Your account is ' . $owner->status]);
        }

        return $next($request);
    }
}
