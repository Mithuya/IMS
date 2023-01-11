<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Models\Exam;
//use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Resources\ExamResource;
use App\Models\Course;
use App\Models\Staff;
use App\Models\Subject;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Exam::with('course','invigilator','examiner')->latest()->paginate(5);
        // return $data;
        return view('modules.exam.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::select('id','title')->get();
        $staffs = Staff::with('user')->get();

        return view('modules.exam.create',compact('courses','staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        $exam = new Exam();

        $exam->course_id = $request->course_id;
        $exam->title = $request->title;
        $exam->description= $request->description;
        $exam->duration= $request->duration;
        $exam->examiner_id= $request->examiner_id;
        $exam->invigilator_id= $request->invigilator_id;
        $exam->date_time = $request->date_time;

        $exam->save();
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
        $exam = Exam::where('id','=',$id)->with('course','invigilator','examiner')->first();
        $courses = Course::select('id','title')->get();

        $staffs = Staff::select('id','user_id')->with('user:id,name')->get();

        return view('modules.exam.show', compact('exam','courses', 'staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::where('id','=',$id)->with('course','invigilator','examiner')->first();
        $courses = Course::select('id','title')->get();
        $staffs = Staff::select('id','user_id')->with('user:id,name')->get();
        return view('modules.exam.edit', compact('exam','courses','staffs'));
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
        $exam->update($request->all());
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
        return redirect()->route('exams.index')->with('success', 'Exam Detail deleted successfully');
    }
}
