<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\AsteriskAmiService;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /*  protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Add the 'phone' field to the credentials array
        $credentials['phone'] = $request->phone;

        return Auth::attempt($credentials, $request->filled('remember'));
    } */

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'phone' => 'required|string|max:255', // Add this line
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // Update the user's phone if provided
            if ($request->has('phone')) {
                $user = Auth::user();
                $user->phone = $request->phone;
                $user->save();
                //session(['temporary_phone' => Auth::user()->phone]);
                $remote = AsteriskAmiService::asterisk_ami();
                $remote->QueuePause('4567', "SIP/9999", 'false', '');
                $remote->QueueRemove('4567', "SIP/9999");
                $remote->QueueAdd('4567', "SIP/9999", 0, "Agent1", "hint:9999@ext-local");
                $remote->QueuePause('4567', "SIP/9999", 'true', 'Toilet');
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        // Clear the temporary phone from the session
        $request->session()->forget('temporary_phone');

        // Update the user's phone to an empty value
        $user = Auth::user();
        $user->phone = '';
        $user->save();

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function showLoginForm()
    {
        $temporaryPhone = session('temporary_phone'); // Retrieve the value from the session
        return view('auth.login', compact('temporaryPhone'));
    }
}
