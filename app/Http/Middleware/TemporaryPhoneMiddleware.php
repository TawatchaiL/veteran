<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class TemporaryPhoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $temporaryPhone = $user ? $user->phone : '';
        $temporaryPhoneStatus = $user ? $user->phone_status : '';
        View::share('temporaryPhone', $temporaryPhone);
        View::share('temporaryPhoneStatus', $temporaryPhoneStatus);
        return $next($request);
    }
}
