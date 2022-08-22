<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HaveARole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }

        return abort(403);
    }
}
