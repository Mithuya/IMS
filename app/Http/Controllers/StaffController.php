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

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Staff::with('user')->latest()->paginate(5);
        return view('modules.staff.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'dob' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'nic' => 'required|regex:/^\d{9}V$/',
            'phno' => 'required|min:10',
        ]);

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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'same:confirm-password',
            'dob' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'nic' => 'required|regex:/^\d{9}V$/',
            'phno' => 'required|min:10',
        ]);

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
        return redirect()->route('staffs.index')->with('success','Staff deleted successfully');
    }
}
