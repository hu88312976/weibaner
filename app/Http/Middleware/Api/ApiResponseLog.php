<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14
 * Time: 9:39
 */

namespace App\Http\Middleware\Api;

use App\Services\Log;
use Closure;

class ApiResponseLog
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        Log::api("response")->info($response, [
            "ip"    => $request->ip(),
            "agent" => $request->server("HTTP_USER_AGENT"),
        ]);

        return $response;
    }
}
