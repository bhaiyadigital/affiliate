<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (!auth()->check()) {
            return redirect()->route('home.index');
        }

        if (!auth()->user()->hasPermission($permission)) {
        return redirect()->route('home.index')->with('error', 'আপনার অনুমতি নেই।');
    }
        return $next($request);
    }
}
