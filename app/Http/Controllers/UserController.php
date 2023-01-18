<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' =>['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::select('id', 'name')->where('name', '!=', 'Admin')->get();
        if (isset($request['search']['value'])) {
            $keyword = $request->search['value'];
        }

        if ($request->role_id != "") {
            $role = Role::select('name')->where('id', '=', $request->role_id)->first();
            if ($role->name == "Student") {
                $users = Student::with('user')->orderBy('user_id', 'DESC');
            } elseif($role->name == "Staff") {
                $users = Staff::with('user')->orderBy('user_id', 'DESC');
            }
            if (isset($request['search']['value'])) {
                $users->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            }
        } else {

            $students = Student::with('user');
            if (isset($request['search']['value'])) {
                $students->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            }
            $staffs = Staff::with('user');
            if (isset($request['search']['value'])) {
                $staffs->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            }
            $users = $staffs->union($students)->orderBy('user_id', 'DESC');     //  Union Staff with Student(merging student and staff) then order by user id
        }

        if ($request->ajax()) {

            return DataTables::of($users)
                ->addColumn('id', function ($row) {
                    return $row->user->id;
                })
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('phno', function ($row) {
                    return "0" . $row->user->phno;
                })
                ->addColumn('action', function ($row) {
                    return $row->user->id;
                })
                ->toJson();
        }

        return view('modules.user.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('modules.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request = $request->validated();

        $request['password'] = Hash::make($request['password']);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phno' => $request->phno,
            'password' => $request->password,
        ]);

        $user->assignRole($request->input('roles'));

        // store other data based on role
        if ($user->hasRole('Staff')) {
            ## if staff
            $staff = new Staff();
            $staff->dob = $request->dob;
            $staff->nic = $request->nic;
            $staff->gender = $request->gender;
            $staff->address = $request->address;
            $user->staffs()->save($staff);
        } elseif ($user->hasRole('Student')) {
            ## if student
            $student = new Student;
            $student->dob = $request->dob;
            $student->nic = $request->nic;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $user->students()->save($student);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::with('user');
        $user = Staff::with('user')->union($students)->where('user_id', '=', $id)->first();
        return view('modules.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $students = Student::with('user');
        $user = Staff::with('user')->union($students)->where('user_id', '=', $id)->first();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->user->roles->pluck('name', 'name')->all();

        return view('modules.user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $request = $request->validated();

        $userData = [
            'name' => $request->name,
            'phno'  => $request->phno
        ];

        if (!empty($request['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        } else

            $user = User::find($id);
        $user->update($userData);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        $otherData = [
            'dob' => $request->dob,
            'nic' => $request->nic,
            'gender' => $request->gender,
            'address' => $request->address,
        ];

        // store other data based on role
        if ($user->hasRole('Staff')) {
            ## if staff
            $user->staffs()->update($otherData);
        } elseif ($user->hasRole('Student')) {
            ## if student
            $user->students()->update($otherData);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request = $request -> validated();

        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        $data = [
            'success' => true,
            'message' => 'User has been deleted successfully.'
        ];

        return response()->json($data);
    }
}
