<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $studentCount = count(Student::get());
        $staffCount = count(Staff::get());
        $courseCount = count(Course::get());
        $examCount = count(Exam::get());

        return view('dashboard.index',compact('studentCount','staffCount','courseCount','examCount'));
    }
}
