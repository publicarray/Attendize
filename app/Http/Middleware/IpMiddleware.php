<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!in_array($request->getClientIp(), ['1.129.110.165', '110.239.26.178', '127.0.0.1']))
        {
            abort(404);
        }
        return $next($request);
    }

}
