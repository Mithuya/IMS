@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">View Courses</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <form method="post" action="{{ route('courses.destroy', $course->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    @can('course-list')
                                        <a href="{{ route('courses.index') }}" class="btn btn-primary btn-sm">View All</a>
                                    @endcan
                                    @can('course-edit')
                                        <a href="{{ route('courses.edit', $course->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Title</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="course_title" class="form-control"
                                    value="{{ $course->title }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Description</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="course_description" class="form-control"
                                    value="{{ $course->description }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Duration</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="course_duration" class="form-control"
                                    value="{{ $course->duration }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Start Date</label>
                            <div class="col-sm-10">
                                <input disabled type="date" name="course_start_date" class="form-control"
                                    value="{{ $course->start_date }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course End Date</label>
                            <div class="col-sm-10">
                                <input disabled type="date" name="course_end_date" class="form-control"
                                    value="{{ $course->end_date }}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
