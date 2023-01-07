@extends('master')

@section('content')




<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">View Exam Details</h4>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
                    </ol>

                </div>
                <div class="col-sm-6">

                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <form method="post" action="{{ route('exams.destroy', $exam->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('exams.index') }}" class="btn btn-primary btn-sm">View All</a>
                                <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">

            <div class="card-body">
                {!! Form::open() !!}
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Select Subject :</label>
                            <div class="col-sm-9">
                                {{-- {!! Form::select('subjects',  $exam->subject->title , ['name'=>'subject_id','class' => 'form-control select2','disabled']) !!} --}}
                                <select disabled class="form-control select2" id="subject_id" name="subject_id">
                                    <option selected disabled>Select</option>
                                    @foreach ($subjects as $subject)
                                        <option {{$subject->id == $exam->id ? 'selected' : ''}} value="{{$subject->id}}">{{$subject->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Exam Title :</label>
                            <div class="col-sm-9">
                                {{-- {!! Form::text('title', $exam->title , ['placeholder' => 'Exam Title', 'class' => 'form-control','disabled']) !!} --}}
                                <input type="text" name="title" disabled value="{{$exam->title}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Exam Description :</label>
                            <div class="col-sm-9">
                                {{-- {!! Form::text('description',$exam->description, ['placeholder' => 'Exam Description', 'class' => 'form-control','disabled']) !!} --}}
                                <input type="text" disabled value="{{$exam->description}}" name="description" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Exam Duration :</label>
                            <div class="col-sm-9">
                                {{-- {!! Form::number('duration', $exam->duration, ['placeholder' => 'Exam Duration', 'class' => 'form-control','disabled']) !!} --}}
                                <input type="number" name="duration" disabled value="{{$exam->duration}}" placeholder="Exam Duration" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Select Examiner :</label>
                            <div class="col-sm-9">
                                <select disabled class="form-control select2" id="examiner_id" name="examiner_id">
                                    <option  disabled>Select</option>
                                    @foreach ($staffs as $staff)
                                        <option {{$staff->id == $exam->examiner_id ? 'selected' : ''}} value="{{$staff->id}}">{{$staff->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Select Invigilator :</label>
                            <div class="col-sm-9">
                                <select disabled class="form-control select2" id="invigilator_id" name="invigilator_id">
                                    <option disabled>Select</option>
                                    @foreach ($staffs as $staff)
                                        <option {{$staff->id == $exam->invigilator_id ? 'selected' : ''}} value="{{$staff->id}}">{{$staff->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-7">
                        <div class="form-group row">
                            <label for="example-name-input" class="col-sm-3 col-form-label">Exam Date :</label>
                            <div class="col-sm-9">
                                <input disabled value="{{$exam->date_time}}" class="form-control" type="datetime-local"  name="date_time">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection('content')
