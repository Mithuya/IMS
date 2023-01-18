@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Subject</h4>
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
                    <form method="post" action="{{ route('subjects.update', $subject->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Select Course</label>
                            <div class="col-sm-10">
                                <select name="course_id" class="form-control select2">
                                    <option>Select Course</option>
                                    <optgroup label="All Courses">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ $subject->course_id == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">subject Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control"
                                    value="{{ $subject->title }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">subject Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control"
                                    value="{{ $subject->description }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">subject Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="duration" class="form-control"
                                    value="{{ $subject->duration }}" />
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
