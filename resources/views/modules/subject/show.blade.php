@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">View Subjects</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <form method="post" action="{{ route('subjects.destroy', $subject->id) }}">
                                    @csrf
                                    @can('subject-list')
                                        <a href="{{ route('subjects.index') }}" class="btn btn-primary btn-sm">View All</a>
                                    @endcan
                                    @can('subject-edit')
                                        <a href="{{ route('subjects.edit', $subject->id) }}"
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
                            <label class="col-sm-2 col-label-form">Subject Title</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="subject_title" class="form-control"
                                    value="{{ $subject->title }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Subject Description</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="subject_description" class="form-control"
                                    value="{{ $subject->description }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Subject Duration</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="subject_duration" class="form-control"
                                    value="{{ $subject->duration }}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
