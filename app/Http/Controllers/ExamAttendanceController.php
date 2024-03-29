<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
        $courses = Course::select('id', 'title')->get();

        if ($request->ajax()) {

            if ($request->search['value'] != "") {

                $keyword = $request->search['value'];
                $students = Student::with('user', 'courses')
                    ->whereHas('courses', function ($query) use ($request) {
                        $query->where('id', '=', $request->course_id);
                    })
                    ->whereHas('user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%");
                    })->get();
            } else {
                $students = Student::with('user', 'courses')
                    ->whereHas('courses', function ($query) use ($request) {
                        $query->where('id', '=', $request->course_id);
                    })->get();
            }

            return DataTables::of($students)
                ->addColumn('DT_RowId', function ($row) {
                    return $row->id;
                })
                ->addColumn('student_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('attendance', function ($row) use ($request) {

                    if ($request->exam_id != '' && $request->course_id != '') {

                        foreach ($row->exams as $exam) {
                            if ($exam->id == $request->exam_id) {
                                return true;
                            }
                        }
                    } else {
                        return "Select Exam";
                    }
                })
                ->toJson();
        }

        return view('modules.exam-attendance.index', compact('courses'));
    }

    public function fetchExams(Request $request)
    {

        $data['exams'] = Exam::where("course_id", $request->course_id)->get(["title", "id"]);
        return response()->json($data);
    }
    public function massPresent(Request $request)
    {
        $students = $request->ids;
        foreach ($students as $student) {
            $student = Student::where('id', '=', $student)->first();
            $student->exams()->attach($request->exam_id);
        }
    }
    public function massUnPresent(Request $request)
    {
        $students = $request->ids;
        foreach ($students as $student) {
            $student = Student::where('id', '=', $student)->first();
            $student->exams()->detach($request->exam_id);
        }
    }
}
