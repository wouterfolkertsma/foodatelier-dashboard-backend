<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{

    protected $guards = [];
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed|void
     */

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);

        if (!auth()->user()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
