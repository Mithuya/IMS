@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="page-title-box">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <h2 class="page-title">Add Student</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">IMS</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                            <li class="breadcrumb-item active">Create New Student</li>
                        </ol>

                    </div>
                    <div class="col-sm-6">

                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
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
                    {!! Form::open(['route' => 'students.store', 'method' => 'POST']) !!}
                    {!! Form::token() !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Name :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Date of Birth :</label>
                                <div class="col-sm-9">
                                    {!! Form::date('dob', null, ['placeholder' => 'Date', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender :</label>
                                <div class="col-sm-9">
                                    {!! Form::select('gender', array('male' => 'Male', 'female' => 'Female'),null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nic Number :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('nic', null, ['placeholder' => 'NIC', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone Number :</label>
                                <div class="col-sm-9">
                                    {!! Form::number('phno', null, ['placeholder' => 'Phone number', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Select Course :</label>
                                <div class="col-sm-9">
                                    {!! Form::select('courses[]', $courses, [], ['class' => 'form-control select2', 'multiple',  'name'=>'course_ids[]', 'id'=>'course_ids[]']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password :</label>
                                <div class="col-sm-9">
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password :</label>
                                <div class="col-sm-9">
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
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



    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>

@endsection('content')
