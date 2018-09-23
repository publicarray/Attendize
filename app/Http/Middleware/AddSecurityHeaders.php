<?php
 namespace App\Http\Middleware;

use Closure;

class AddSecurityHeaders
{
    /**
     * Add Security headers https://securityheaders.io/
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        return $response->withHeaders([
                'Referrer-Policy' => 'same-origin',
                'Feature-Policy' => "vibrate 'none'; camera 'self'; microphone 'none'; geolocation 'none' vr 'none'; usb 'none'",
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'sameorigin',
                'X-XSS-Protection' => '1; mode=block',
            ]);
    }
}
