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
        $temporaryPhoneIP = $user ? $user->phone_ip : '';
        $temporaryPhoneStatusID = $user ? $user->phone_status_id : '';
        $temporaryPhoneStatus = $user ? $user->phone_status : '';
        $temporaryPhoneStatusIcon = $user ? $user->phone_status_icon : '';
        $temporaryLogintime = $user ? $user->login_time : '';
        $temporaryLogofftime = $user ? $user->logoff_time : '';
        View::share('temporaryPhone', $temporaryPhone);
        View::share('temporaryPhoneIP', $temporaryPhoneIP);
        View::share('temporaryPhoneStatusID', $temporaryPhoneStatusID);
        View::share('temporaryPhoneStatus', $temporaryPhoneStatus);
        View::share('temporaryPhoneStatusIcon', $temporaryPhoneStatusIcon);
        View::share('temporaryLogintime', $temporaryLogintime);
        View::share('temporaryLogofftime', $temporaryLogofftime);
        return $next($request);
    }
}
