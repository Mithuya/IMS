<?php

namespace App\Http\Controllers;

use App\Models\ExamAttendance;
use App\Http\Requests\StoreExamAttendanceRequest;
use App\Http\Requests\UpdateExamAttendanceRequest;

class ExamAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ExamAttendance::with('student')->latest()->paginate(5);
        // return $data;
        return view('modules.exam-attendance.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
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
    public function store(StoreExamAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(ExamAttendance $examAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamAttendance $examAttendance)
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
    public function update(UpdateExamAttendanceRequest $request, ExamAttendance $examAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamAttendance  $examAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamAttendance $examAttendance)
    {
        //
    }
}
