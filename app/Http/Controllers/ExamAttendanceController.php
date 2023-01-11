<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $result = Student::with('user','courses.exams','exams')->get();
        // return $result;



        if ($request->ajax()) {

            // $exam_attendance_details = Student::select(sprintf('%s.*', (new Student())->getTable()));
            $row = Student::with('user','courses.exams','exams');
            // return $exam_attendance_details;
            $exams_of_student_array = [];


            return DataTables::eloquent($row)
                ->setRowId('id')
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('student', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('exams_of_student', function (Student $student) use($exams_of_student_array) {

                    return $student->courses->map(function($course) use($exams_of_student_array){
                        return $course->exams->map(function($exam) use($exams_of_student_array){

                            return $exam->id;
                            // array_push($exams_of_student_array,$exam -> id);
                            // return $exams_of_student_array[0];
                        });
                    });

                })
                ->addColumn('writtens_exam', function (Student $student) {
                    return $student->exams->map(function($exam){
                        return $exam -> id;
                    });
                })
                ->addColumn('is_present', function ($row) {
                    return true;
                })
                ->filterColumn('student', function ($query, $keyword) {
                    $sql = "users.name like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->toJson();
        }

        return view('modules.exam-attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.exam-attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function show( $examAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit( $examAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamAttendanceRequest  $request
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $examAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy( $examAttendance)
    {
        //
    }
    public function massAttendance( $examAttendance)
    {
        //
    }
}
