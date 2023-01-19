<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:student-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:student-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:student-delete', ['only' => ['destroy']]);
        $this->middleware('permission:student-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $students = Student::with('user')->orderBy('user_id', 'DESC');

        if (isset($request['search']['value'])) {
            $keyword = $request->search['value'];
            $students->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%");
            });
        }

        if ($request->ajax()) {

            return DataTables::of($students)
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

        return view('modules.student.index');
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
    public function store(StoreStudentRequest $request)
    {
        $request->validated();
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
        $student = Student::Where('id', '=', $id)->with('user', 'courses')->first();
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
        $student = Student::Where('id', '=', $id)->with('user', 'courses')->first();
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
    public function update(UpdateStudentRequest $request, $id)
    {
        $request->validated();
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

        $data = [
            'success' => true,
            'message' => 'Student has been deleted successfully.'
        ];

        return response()->json($data);
    }
}
