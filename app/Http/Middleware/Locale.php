<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Helper;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Helper::changeLanguage();

        return $next($request);
    }
}
