@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <h4 class="page-title">Add Subject</h4>
                        <ol class="breadcrumb">
                        </ol>

                    </div>
                    <div class="col-sm-6">

                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">

                <div class="card-body">
                    <form method="post" action="{{ route('subjects.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Select Course</label>
                            <div class="col-sm-10">
                                <select name="course_id" class="form-control select2">
                                    <option>Select Course</option>
                                    <optgroup label="All Courses">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Subject Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" />
                                @error('subject_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">subject Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" />
                                @error('subject_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Subject Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="duration" class="form-control" />
                                @error('subject_duration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
