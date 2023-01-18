<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exams = Exam::select('id', 'title')->get();

        if ($request->ajax()) {

            if ($request->search['value'] != "") {

                $keyword = $request->search['value'];
                $students = Student::with('user', 'exams')
                    ->whereHas('exams', function ($query) use ($request) {
                        $query->where('id', '=', $request->exam_id);
                    })
                    ->whereHas('user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%");
                    })->get();
            } else {
                $students = Student::with('user', 'exams')
                    ->whereHas('exams', function ($query) use ($request) {
                        $query->where('id', '=', $request->exam_id);
                    });
            }

            return DataTables::of($students)
                ->addColumn('DT_RowId', function ($row) {
                    return $row->id;
                })
                ->addColumn('student_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('exam-attendance', function ($row) use ($request) {

                    if ($request->exam_id != '') {

                        foreach ($row->exams as $exam) {
                            if ($exam->id == $request->exam_id) {
                                return "Present";
                            }
                        }
                    } else {
                        return "Select Exam";
                    }
                })
                ->addColumn('exam-result', function ($row) use ($request) {

                    if ($request->exam_id != '') {
                        foreach ($row->exams as $exam) {
                            if ($exam->id == $request->exam_id) {
                                return $exam->pivot->result;
                            }
                        }
                    } else {
                        return "Select Exam";
                    }
                })
                ->addColumn('enter_mark', function ($row) use ($request) {
                    if ($request->exam_id != '') {

                        foreach ($row->exams as $exam) {
                            if ($exam->id == $request->exam_id) {
                                return true;
                            }
                        }
                    } else {
                        return false;
                    }
                })
                ->toJson();
        }

        return view('modules.result.index', compact('exams'));
    }

    public function fetchExams(Request $request)
    {

        $data['exams'] = Exam::where("course_id", $request->course_id)->get(["title", "id"]);
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $exams = Exam::select('id', 'title')->get();
        $student = Student::where('id', '=', $request->student_id)->first();

        $student->exams()->updateExistingPivot($request->exam_id, [
            'result' => $request->result,
        ]);
        $data = [
            'success' => true,
            'message' => 'Result has been updated successfully.'
        ];

        return response()->json($data);
    }
}
