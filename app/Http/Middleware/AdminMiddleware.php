<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
    if (! auth()->check() || ! auth()->user()->is_admin) {
        abort(403, 'Accès refusé');
    }
    return $next($request);
}

}
