<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetOneMinuteCacheHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $seconds): Response
    {
        $response = $next($request);

        if (ctype_digit($seconds)) {
            $response->setCache(['max_age' => $seconds, 'public' => true]);
        }

        return $response;
    }
}
