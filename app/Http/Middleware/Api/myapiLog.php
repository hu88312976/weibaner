<?php
namespace App\Http\Middleware\Api;

use App\Services\Log;
use Closure;

class ApiLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::api("request")->info("api" . $request->server("HTTP_USER_AGENT"), array_merge($request->all(), [
            "ip"                        => $request->ip(),
            "uri"                       => $request->url(),
            "client_ip"                 => $request->getClientIp(),
            "getAcceptableContentTypes" => $request->getAcceptableContentTypes(),
        ]));

        return $next($request);
    }
}
