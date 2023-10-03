<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\AsteriskAmiService;
use App\Services\ECCP;
use App\Services\ECCPUnauthorizedException;

use App\Models\User;

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
    protected $remote;
    protected $eccp;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AsteriskAmiService $asteriskAmiService) // Inject AsteriskAmiService
    {
        $this->middleware('guest')->except('logout');
        $this->remote = $asteriskAmiService; // Initialize $remote
        $this->eccp = new ECCP();
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
            'phone' => 'required|string|max:255', // เพิ่มบรรทัดนี้
        ], [
            $this->username() . '.required' => 'กรุณากรอก' . $this->username(),
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'phone.required' => 'กรุณากรอกหมายเลขโทรศัพท์', // เพิ่มบรรทัดนี้
        ]);
    }

    public function logoff_to_login_phone_error($message)
    {
        auth()->logout();
        return redirect()->route('login')
            ->with('login_error', $message)
            ->withErrors(['phone' => $message]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // Update the user's phone if provided
            if ($request->has('phone')) {
                $user = Auth::user();
                $user->phone = $request->phone;

                //check phone status
                $phone_state_num = $this->remote->exten_state($user->phone);
                if ($phone_state_num == 4 || $phone_state_num == -1) {
                    $this->logoff_to_login_phone_error('หมายเลขโทรศัพท์ไม่พร้อมใช้งาน');
                }

                //check in use
                $inuseCount = User::where('phone', $user->phone)
                    ->where('agent_id', '!=', $user->id)
                    ->count();

                if ($inuseCount > 0) {
                    $this->logoff_to_login_phone_error('หมายเลขโทรศัพท์ถูกใช้งานแล้ว');
                } /* else {
                    //check login again with same phone and same agent
                    if ($agent_data['extension'] == $phone) {
                        $not_logout = $this->Agent_model->get_state_not_logout($phone, $agent_data['id_agent']);
                        if ($not_logout) {
                            $this->clear_login(
                                $not_logout['login_datetime'],
                                $not_logout['id_agent'],
                                $not_logout['enable_inbound'],
                                $not_logout['queues_inbound'],
                                $not_logout['extension'],
                                $remote_context,
                                $not_logout['audit_login_id']
                            );
                        }
                    } else {
                        //check not logout same agent not same phone
                        $not_logout = $this->Agent_model->get_agent_not_logout($agent_data['id_agent']);
                        if ($not_logout) {
                            $this->clear_login(
                                $not_logout['login_datetime'],
                                $not_logout['id_agent'],
                                $not_logout['enable_inbound'],
                                $not_logout['queues_inbound'],
                                $not_logout['extension'],
                                $remote_context,
                                $not_logout['audit_login_id']
                            );
                        }
                    }
                }*/

                $queueNames = $user->queues->pluck('queue_name')->implode(',');
                $user->queue = $queueNames;
                $user->save();
                //session(['temporary_phone' => Auth::user()->phone]);

                /* $this->remote->QueuePause('4567', "SIP/9999", 'false', '');
                $this->remote->QueueRemove('4567', "SIP/9999");
                $this->remote->QueueAdd('4567', "SIP/9999", 0, "Agent1", "hint:9999@ext-local");
                $this->remote->QueuePause('4567', "SIP/9999", 'true', 'Toilet'); */
                //$this->remote->queue_log_in($queueNames, $request->phone);

                $sUsernameECCP = 'agentconsole';
                $sPasswordECCP = 'agentconsole';
                $cr = $this->eccp->connect("10.148.0.4", $sUsernameECCP, $sPasswordECCP);
                if (isset($cr->failure)) {
                    throw new ECCPUnauthorizedException('Failed to authenticate to ECCP') . ': ' . ((string)$cr->failure->message);
                }
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        // Clear the temporary phone from the session
        //$request->session()->forget('temporary_phone');

        // Update the user's phone to an empty value
        $user = Auth::user();
        $this->remote->queue_log_off($user->queue, $user->phone);
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
