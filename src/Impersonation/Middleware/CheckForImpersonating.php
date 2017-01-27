<?php

namespace LaraComponents\Impersonation\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckForImpersonating
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isImpersonating()) {
            Auth::guard()->onceUsingId($request->user()->getImpersonatingId());
        }

        return $next($request);
    }
}
