<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:staff-list|staff-create|staff-edit|staff-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:staff-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:staff-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:staff-delete', ['only' => ['destroy']]);
        $this->middleware('permission:staff-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $staffs = Staff::with('user')->orderBy('user_id', 'DESC');

        if (isset($request['search']['value'])) {
            $keyword = $request->search['value'];
            $staffs->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%");
            });
        }

        if ($request->ajax()) {

            return DataTables::of($staffs)
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('phno', function ($row) {
                    return "0" . $row->user->phno;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->toJson();
        }

        return view('modules.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::pluck('title', 'id')->all();
        return view('modules.staff.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStaffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaffRequest $request)
    {
        $request -> validated();
        $request['password'] = Hash::make($request['password']);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phno' => $request->phno,
            'password' => $request->password,
        ]);

        $role = Role::all('*')->where('name', '=', 'Staff')->first();
        $user->assignRole([$role->id]);

        $staff = new Staff;
        $staff->dob = $request->dob;
        $staff->nic = $request->nic;
        $staff->gender = $request->gender;
        $staff->address = $request->address;
        $user->staffs()->save($staff);


        $staff->subjects()->attach($request->subject_ids);


        return redirect()->route('staffs.index')
            ->with('success', 'staff created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::Where('id', '=', $id)->with('user','subjects')->first();
        $subjectsTeaching = Staff::Where('id', '=', $id)->with('subjects')->first();

        $subjectsTeachingIds = [];
        foreach ($subjectsTeaching->subjects as $subject) {
           array_push($subjectsTeachingIds, $subject->id);
        }
        $availableSubjects= Subject::get()->pluck('title', 'id');

        return view('modules.staff.show', compact('staff', 'availableSubjects', 'subjectsTeachingIds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::Where('id', '=', $id)->with('user','subjects')->first();
        $subjectsTeaching = Staff::Where('id', '=', $id)->with('subjects')->first();

        $subjectsTeachingIds = [];
        foreach ($subjectsTeaching->subjects as $subject) {
           array_push($subjectsTeachingIds, $subject->id);
        }
        $availableSubjects= Subject::get()->pluck('title', 'id');

        return view('modules.staff.edit',  compact('staff', 'availableSubjects', 'subjectsTeachingIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStaffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffRequest $request, $id)
    {
        $request -> validated();
        $userData = [
            'name' => $request->name,
            'phno'  => $request->phno
        ];

        if (!empty($request['password'])) {
            $userData['password'] = Hash::make($request['password']);
        }

        $staffData = [
            'dob' => $request->dob,
            'nic' => $request->nic,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
        $staff = Staff::find($id);
        $staff->update($staffData);


        $staff->user()->update($userData);
        $staff->subjects()->sync($request->subject_ids);

        return redirect()->route('staffs.index')
            ->with('success', 'Staff updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::Where('id', '=', $id)->with('user')->first();
        User::find($staff->user->id)->delete();        //on delete cascade

        $data = [
            'success' => true,
            'message' => 'Staff has been deleted successfully.'
        ];

        return response()->json($data);
    }
}
