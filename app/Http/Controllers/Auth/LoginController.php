<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\AsteriskAmiService;
use App\Services\IssableService;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


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
    protected $issable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AsteriskAmiService $asteriskAmiService) // Inject AsteriskAmiService
    {
        $this->middleware('guest')->except('logout');
        $this->remote = $asteriskAmiService; // Initialize $remote
        $this->issable = new IssableService();
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
        //auth()->logout();
        return redirect()->route('login')
            ->with('login_error', $message)
            ->withErrors(['phone' => $message]);
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        //check already login
        /* $inuseUCount = User::where('phone', '!=', '')
            ->where('email', '=', $request->get('email'))
            ->count();

        if ($inuseUCount > 0) {
            return redirect()->route('login')
                ->with('login_error', 'User นี้ กำลังใช้งานอยู่')
                ->withErrors(['email' => 'User นี้ กำลังใช้งานอยู่']);
        } */

        //check phone status
        $phone_state_num = $this->remote->exten_state($request->get('phone'));
        if ($phone_state_num == 4 || $phone_state_num == -1) {
            //check phone status
            return redirect()->route('login')
                ->with('login_error', 'หมายเลขโทรศัพท์ไม่พร้อมใช้งาน')
                ->withErrors(['email' => 'หมายเลขโทรศัพท์ไม่พร้อมใช้งาน']);
        }


        if ($this->attemptLogin($request)) {
            // Update the user's phone if provided
            if ($request->has('phone')) {
                $user = Auth::user();
                $user->phone = $request->phone;

                //check active
                $issable = DB::connection('remote_connection')
                    ->table('call_center.agent')
                    //->where('id', $user->agent_id)
                    ->where('number', $user->phone)
                    ->orderBy('id', 'desc')
                    ->first();
                if ($issable) {
                    if ($issable->estatus == 'I') {
                        auth()->logout();
                        return redirect()->route('login')
                            ->with('login_error', 'กรุณาติดต่อผู้ดูแลระบบ')
                            ->withErrors(['email' => 'กรุณาติดต่อผู้ดูแลระบบ']);
                    }
                } else {
                    auth()->logout();
                    return redirect()->route('login')
                        ->with('login_error', 'กรุณาติดต่อผู้ดูแลระบบ')
                        ->withErrors(['email' => 'กรุณาติดต่อผู้ดูแลระบบ']);
                }


                //check in use
                /* $inuseCount = DB::connection('remote_connection')
                    ->table('call_center.agent')
                    ->where('id', '!=', $user->agent_id)
                    ->where('number', '=', $request->phone)
                    ->count(); */
                $inuseCount = User::where('id', '!=', $user->id)
                    ->where('phone', '=', $request->phone)
                    ->count();

                if ($inuseCount > 0) {
                    //$this->logoff_to_login_phone_error('หมายเลขโทรศัพท์ถูกใช้งานแล้ว');
                    auth()->logout();
                    return redirect()->route('login')
                        ->with('login_error', 'หมายเลขโทรศัพท์ถูกใช้งานแล้ว')
                        ->withErrors(['email' => 'หมายเลขโทรศัพท์ถูกใช้งานแล้ว']);
                } else {
                    $user->agent_id = $issable->id;
                }


                $not_logout = DB::connection('remote_connection')
                    ->table('call_center.audit')
                    //->where('id_agent', $issable->id)
                    ->where('crm_id', $user->id)
                    ->whereNull('id_break')
                    ->whereNull('datetime_end')
                    ->get();
                //check login again with same phone and same agent  and logout_datetime IS NULL
                if (count($not_logout) > 0) {
                    $not_logout_agent = DB::connection('remote_connection')
                        ->table('call_center.agent')
                        //->where('id', $user->agent_id)
                        ->where('id', $not_logout[0]->id_agent)
                        ->get();
                    $this->clear_login($user->agent_id, $not_logout_agent[0]->number);
                }

                $queueNames = $user->queues->pluck('queue_name')->implode(',');
                $user->queue = $queueNames;
                /* $user->phone_status_id = 0;
                $user->phone_status = "ไม่พร้อมรับสาย";
                $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-xmark"></i>'; */
                $user->phone_status_id = 1;
                $user->phone_status = "พร้อมรับสาย";
                $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
                $user->login_time = Carbon::now();
                $user->save();

                Session::put('login_time', $user->login_time);

                // Update 'number' in the 'call_center.agent' table
                /* DB::connection('remote_connection')
                    ->table('call_center.agent')
                    ->where('id', $user->agent_id)
                    ->update(['number' => $user->phone]); */


                $this->issable->agent_login($user->phone);

                DB::connection('remote_connection')
                    ->table('call_center.audit')
                    ->where('id_agent', $user->agent_id)
                    ->whereNull('datetime_end')
                    ->update(['crm_id' => $user->id]);


                //$this->issable->agent_login($user->phone);
                //session(['temporary_phone' => Auth::user()->phone]);

            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    public function clear_login($agent_id, $phone)
    {

        $this->issable->agent_logoff($phone);
        //update agent number
        /* DB::connection('remote_connection')
            ->table('call_center.agent')
            ->where('id', $agent_id)
            ->update(['number' => 0]); */
    }


    public function logout(Request $request)
    {

        // Clear the temporary phone from the session
        //$request->session()->forget('temporary_phone');
        $user = Auth::user();
        //$this->remote->queue_log_off($user->queue, $user->phone);
        if ($user->phone_status_id !== 0) {
            $this->issable->agent_logoff($user->phone);
        }

        $user->phone = '';
        $user->agent_id = 0;
        $user->phone_status_id = 0;
        $user->phone_status = "ไม่พร้อมรับสาย";
        $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-xmark"></i>';
        $user->logoff_time = Carbon::now();
        $user->save();

        /* DB::connection('remote_connection')
            ->table('call_center.agent')
            ->where('id', $user->agent_id)
            ->update(['number' => 0]); */

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
