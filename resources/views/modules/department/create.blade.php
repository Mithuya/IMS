@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <h4 class="page-title">Add Subject</h4>
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
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
            {{-- @if ($errors->any())

        <div class="alert alert-danger">
            <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach
            </ul>
        </div>

        @endif --}}

            <div class="card">

                <div class="card-body">
                    <form method="post" action="{{ route('subjects.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Department Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="department" class="form-control" />
                                @error('subject_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
                            <label class="col-sm-2 col-label-form">Select Subject</label>
                            <div class="col-sm-10">
                                <select name="subject" class="form-control select2">
                                    <option>Select Subject</option>
                                    <optgroup label="All Subject">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ $subject->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Select Staff</label>
                            <div class="col-sm-10">
                                <select name="staff" class="form-control select2">
                                    <option>Select Staff</option>
                                    <optgroup label="All Staff">
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">
                                                {{ $staff->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Select Subject</label>
                            <div class="col-sm-10">
                                <select name="subject" class="form-control select2">
                                    <option>Select Subject</option>
                                    <optgroup label="All Subject">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ $subject->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
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
