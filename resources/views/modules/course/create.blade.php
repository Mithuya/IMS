@extends('master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Add Courses</h4>
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
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Course Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Course Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control"  />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Course Duration</label>
                        <div class="col-sm-10">
                            <input type="text" name="duration" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Course Start Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date" class="form-control"  />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Course End Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="end_date" class="form-control"  />
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
