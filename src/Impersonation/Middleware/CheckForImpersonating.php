<?php

namespace LaraComponents\Impersonation\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class CheckForImpersonating
{
    /**
     * The authentication factory implementation.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

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
            $this->auth->onceUsingId($request->user()->getImpersonatingId());
        }

        return $next($request);
    }
}
