@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h2 class="page-title">Add Exam Detail</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">IMS</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Exams</a></li>
                            <li class="breadcrumb-item active">Create Exam Detail</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a class="btn btn-primary" href="{{ route('exams.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'exams.store', 'method' => 'POST']) !!}
                    {!! Form::token() !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Select Course :</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="course_id" name="course_id">
                                        <option selected disabled>Select</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Exam Title :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" placeholder="Exam Title" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Exam Description :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="description" placeholder="Exam Description"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Exam Duration :</label>
                                <div class="col-sm-9">
                                    <input type="number" name="duration" placeholder="Exam Duration" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Select Examiner :</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="examiner_id" name="examiner_id">
                                        <option selected disabled>Select</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Select Invigilator :</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="invigilator_id" name="invigilator_id">
                                        <option selected disabled>Select</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Exam Date :</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="datetime-local" name="date_time">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-7 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection('content')
