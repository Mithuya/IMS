<?php

namespace App\Http\Controllers;

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
        $data = Exam::with('subject','invigilator','examiner')->latest()->paginate(5);
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
        $subjects = Subject::select('id','title')->get();
        $staffs = Staff::with('user')->get();

        return view('modules.exam.create',compact('subjects','staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validation
         $this->validate($request, [
            'title' => 'required',
            'subject_id' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'examiner_id' => 'required',
            'invigilator_id' => 'required',
            'date_time' => 'required',
         ]);

        // return $request;

        $exam = new Exam();

        $exam->subject_id = $request->subject_id;
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

        $exam = Exam::where('id','=',$id)->with('subject','invigilator','examiner')->first();
        $subjects = Subject::select('id','title')->get();

        // $staffs = Staff::query()
        //     ->with(['user' => function ($query) {
        //         $query->select('id', 'name');       // get id is important to match relation
        //     }])
        //     ->get(['id','user_id']);                // get user_id is important to match relation


        $staffs = Staff::select('id','user_id')->with('user:id,name')->get();  //simplication of above query

        return view('modules.exam.show', compact('exam','subjects', 'staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::where('id','=',$id)->with('subject','invigilator','examiner')->first();
        $subjects = Subject::select('id','title')->get();
        $staffs = Staff::select('id','user_id')->with('user:id,name')->get();
        return view('modules.exam.edit', compact('exam','subjects','staffs'));
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
