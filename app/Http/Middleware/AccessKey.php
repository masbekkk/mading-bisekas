<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class AccessKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $access_key = $request->header('access-key');
        if ($access_key) {
            $access_key = Crypt::decryptString($access_key);
            if ($access_key == env('ACCESS_KEY_APP')) {
                return $next($request);
            }
            return formatResponse('error', 'Forbidden Access', null, 403, 403);
        }
        return formatResponse('error', 'Forbidden Access', null, 403, 403);
    }
}
