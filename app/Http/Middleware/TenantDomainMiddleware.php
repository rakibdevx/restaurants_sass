<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Owner\Owner;
use Illuminate\Support\Carbon;

class TenantDomainMiddleware
{
    protected $mainDomains = [];

    public function handle(Request $request, Closure $next)
    {
        $this->mainDomains = [
            trim(setting('site_url')),
        ];
        $host = $request->getHost();

        if (in_array($host, $this->mainDomains)) {
            app()->instance('domain_type', 'main');
            return $next($request);
        }

        $owner = Owner::where('domain', $host)->first();

        if ($owner && $owner->expiry_time) {
            if ($owner->expiry_time && now()->gt($owner->expiry_time)) {
                abort(403, 'Your subscription has expired');
            }
        }

        if (!$owner && str_contains($host, '.'.setting('site_url'))) {
            $username = explode('.', $host)[0];
            $owner = Owner::where('username', $username)->first();
        }

        if (!$owner) {
            abort(404, "No URL setup on this domain");
        }
        app()->instance('domain_type', 'custome');
        app()->instance('tenant', $owner->id);

        return $next($request);
    }
}
