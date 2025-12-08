<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
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
