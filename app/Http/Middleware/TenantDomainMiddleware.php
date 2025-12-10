<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Owner\Owner;

class TenantDomainMiddleware
{
    protected $mainDomains = [];

    public function __construct()
    {
        $this->mainDomains = [
            setting('site_url'),
        ];
    }


    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();

        if (in_array($host, $this->mainDomains)) {
            return $next($request);
        }

        $owner = Owner::where('domain', $host)->first();

        if (!$owner && str_contains($host, '.main.com')) {
            $username = explode('.', $host)[0];
            $owner = Owner::where('username', $username)->first();
        }

        if (!$owner) {
            abort(404, "No Url setup On this Domain");
        }

        app()->instance('tenant', $owner);

        return $next($request);
    }
}
