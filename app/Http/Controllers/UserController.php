<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy', 'destroy_all']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*  $data = User::orderBy('id', 'DESC')->paginate(5);
        $roles = Role::pluck('name', 'name')->all();
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('roles', $roles); */
        $roles = Role::pluck('name', 'name')->all();
        if ($request->ajax()) {
            //sleep(2);

            $datas = User::with('department', 'position')->orderBy("id", "desc")->get();
            return datatables()->of($datas)
                ->editColumn('role', function (User $datas) {
                    if (!empty($datas->getRoleNames())) {
                        $urole = '';
                        foreach ($datas->getRoleNames() as $v) {
                            $urole = $v;
                        }
                    } else {
                        $urole = '-';
                    }

                    return $urole;
                })
                ->editColumn('department', function ($row) {
                    return $row->department->name;
                })
                ->editColumn('position', function ($row) {
                    return $row->position->name;
                })
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('user-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('user-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }
        $department = Department::where([['status', '1']])
            ->orderBy("name", "asc")->get();
        $position = Position::where([['status', '1']])
            ->orderBy("name", "asc")->get();
        return view('users.index')->with('roles', $roles)
            ->with(['department' => $department])
            ->with(['position' => $position]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]); */

        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'required',
            'position_id' => 'required',
            'name' => 'required|string|max:255',
            'role' => 'required'
        ]);



        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('role'));

        /*  return redirect()->route('users.index')
            ->with('success', 'User created successfully'); */
        return response()->json(['success' => 'เพิ่มช้อมูล ผู้ใช้งาน เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*   public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        //$userRole = $data->roles->pluck('name', 'name')->all();
        //dd($roles);
        //dd($userRole);

        if (!empty($data->getRoleNames())) {
            foreach ($data->getRoleNames() as $v) {
                $urole = $v;
            }
        }

        $rolese = '';
        foreach ($roles as $role) {
            if ($role == $urole) {
                $sselected = "selected";
            } else {
                $sselected = "";
            }

            $rolese .= '<option value="' . $role . '" ' . $sselected . '>' . $role . '</option>';
        }

        $position = Position::where([['id', $data->position_id]])->get();
        $select_list_position = '<option value="' . $position[0]->id . '" > ' . $position[0]->name . '</option>';



        return response()->json(['data' => $data, 'html' => $rolese, 'select_list_position' => $select_list_position]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
       */

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'department' => 'required',
            'position' => 'required',
        ];

        if ($request->get('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validator =  Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $users = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'department_id' => $request->get('department'),
            'position_id' => $request->get('position'),
            //'password' => Hash::make($request->get('password')),
        ];


        if ($request->get('password')) {
            $users['password'] = Hash::make($request->get('password'));
        }
        $user = User::find($id);
        $user->update($users);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('role'));

        return response()->json(['success' => 'บันทึกข้อมูล ผู้ใช้งาน เรียบร้อยแล้ว']);

        /* return redirect()->route('users.index')
            ->with('success', 'User updated successfully'); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /*    if (!Auth::user()->hasPermissionTo('user-delete')) {
            return response()->json(['errors' => 'คุณไม่มีสิทธิ์ลบข้อมูล.'], 200);
        } */
        $id = $request->get('id');
        User::find($id)->delete();
        return ['success' => true, 'message' => 'ลบข้อมูล ผู้ใช้งาน เรียบร้อยแล้ว'];
        /* return redirect()->route('users.index')
            ->with('success', 'User deleted successfully'); */
    }

    public function destroy_all(Request $request)
    {

        /*  if (!Auth::user()->hasPermissionTo('user-delete')) {
            return response()->view('errors.403', [], 403);
        } */
        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            User::find($arr_del[$xx])->delete();
        }
        //$ids = $request->get('table_records');
        //User::whereIn('id',explode(",",$ids))->delete();
        return redirect('/users')->with('success', 'ลบข้อมูล ผู้ใช้งาน ผู้ใช้งาน');
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function perform()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
