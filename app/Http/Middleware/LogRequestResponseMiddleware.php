<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $recordRequestContent = $request->all();

        $replace = ['\n', '\t'];
        $parameter = str_replace($replace, '', json_encode($recordRequestContent, JSON_UNESCAPED_UNICODE));

        $msg =
            'REQUEST: ' . $request->getMethod() . ' ' . $request->getRequestUri() . ' ' . $parameter . ', ' .
            'RESPONSE: ' . $response->getStatusCode() . ' ' . json_encode(json_decode($response->getContent(), true), JSON_UNESCAPED_UNICODE);

        Log::info($msg);

        return $next($request);
    }
}
