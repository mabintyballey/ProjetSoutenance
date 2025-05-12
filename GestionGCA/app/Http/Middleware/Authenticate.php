<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('administration/*')) {
                return route('login.admin');
            } elseif ($request->is('avocat/*')) {
                return route('login.avocat');
            } else {
                return route('login');
            }
        }
    }

}
