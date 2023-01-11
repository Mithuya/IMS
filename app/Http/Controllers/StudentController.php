<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::with('user')->latest()->paginate(5);
        return view('modules.student.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::pluck('title', 'id')->all();
        return view('modules.student.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
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
            'nic' => 'required',
            'phno' => 'required|min:10',
        ]);

        $request['password'] = Hash::make($request['password']);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phno' => $request->phno,
            'password' => $request->password,
        ]);

        $role = Role::all('*')->where('name', '=', 'Student')->first();
        $user->assignRole([$role->id]);

        $student = new Student;
        $student->dob = $request->dob;   // $student['dob'] = $request['dob']
        $student->nic = $request->nic;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $user->students()->save($student);


        $student->courses()->attach($request->course_ids);


        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::Where('id', '=', $id)->with('user','courses')->first();
        $coursesStudying = Student::Where('id', '=', $id)->with('courses')->first();

        $coursesStudyingIds = [];
        foreach ($coursesStudying->courses as $course) {
           array_push($coursesStudyingIds, $course->id);
        }
        $availableCourses = Course::get()->pluck('title', 'id');

        return view('modules.student.show', compact('student', 'availableCourses', 'coursesStudyingIds'));
    }



    public function edit($id)
    {
        $student = Student::Where('id', '=', $id)->with('user','courses')->first();
        $coursesStudying = Student::Where('id', '=', $id)->with('courses')->first();

        $coursesStudyingIds = [];
        foreach ($coursesStudying->courses as $course) {
           array_push($coursesStudyingIds, $course->id);
        }
        $availableCourses = Course::get()->pluck('title', 'id');

        return view('modules.student.edit', compact('student', 'availableCourses', 'coursesStudyingIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
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
            'nic' => 'required',
            'phno' => 'required|min:10',
        ]);

        $userData = [
            'name' => $request->name,
            'phno'  => $request->phno
        ];

        if (!empty($request['password'])) {
            $userData['password'] = Hash::make($request['password']);
        }

        $studentData = [
            'dob' => $request->dob,
            'nic' => $request->nic,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
        $student = Student::find($id);
        $student->update($studentData);


        $student->user()->update($userData);
        $student->courses()->sync($request->course_ids);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::Where('id', '=', $id)->with('user')->first();
        User::find($student->user->id)->delete();        //on delete cascade
        return redirect()->route('students.index')->with('success','Student deleted successfully');
    }
}
