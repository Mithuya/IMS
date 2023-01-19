@extends('master')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Courses</h4>
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
                    <form method="post" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control"
                                    value="{{ $course->title }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control"
                                    value="{{ $course->description }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="duration" class="form-control"
                                    value="{{ $course->duration }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course Start Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ $course->start_date }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Course End Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ $course->end_date }}" />
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


@endsection('content')
