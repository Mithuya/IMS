<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Models\Exam;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Course;
use App\Models\Staff;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:exam-list|exam-create|exam-edit|exam-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:exam-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:exam-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:exam-delete', ['only' => ['destroy']]);
        $this->middleware('permission:exam-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::select('id', 'title')->get();

        $exams = Exam::with('course', 'invigilator', 'examiner')->orderBy('id', 'DESC');
        if (isset($request['course_id']) && $request['course_id'] != null) {
            $course_id = $request['course_id'];
            $exams->whereHas('course', function ($q) use ($course_id) {
                $q->where('id', '=', $course_id);
            });
        }
        if (isset($request['search']['value'])) {
            $keyword = $request->search['value'];
            $exams->where('title', 'like', "%$keyword%");
        }

        if ($request->ajax()) {

            return DataTables::of($exams)
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('course', function ($row) {
                    return $row->course->title;
                })
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('invigilator', function ($row) {
                    return $row->invigilator->user->name;
                })
                ->addColumn('examiner', function ($row) {
                    return $row->examiner->user->name;
                })
                ->addColumn('date_time', function ($row) {
                    return $row->date_time;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->toJson();
        }

        return view('modules.exam.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::select('id', 'title')->get();
        $staffs = Staff::with('user')->get();

        return view('modules.exam.create', compact('courses', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        $exam = Exam::create($request->validated());
        return redirect()->route('exams.index')->with('success', 'Exam Detail Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::where('id', '=', $id)->with('course', 'invigilator', 'examiner')->first();
        $courses = Course::select('id', 'title')->get();

        $staffs = Staff::select('id', 'user_id')->with('user:id,name')->get();

        return view('modules.exam.show', compact('exam', 'courses', 'staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::where('id', '=', $id)->with('course', 'invigilator', 'examiner')->first();
        $courses = Course::select('id', 'title')->get();
        $staffs = Staff::select('id', 'user_id')->with('user:id,name')->get();
        return view('modules.exam.edit', compact('exam', 'courses', 'staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());
        return redirect()->route('exams.index')->with('success', 'Exam Detail has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        $data = [
            'success' => true,
            'message' => 'Exam has been deleted successfully.'
        ];

        return response()->json($data);
    }
}
