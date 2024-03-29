@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Student</h4>
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
                    {!! Form::model($student, ['method' => 'PATCH', 'route' => ['students.update', $student->id]]) !!}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Name :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" placeholder="Name"
                                        value="{{ $student->user->name }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Date of Birth :</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dob" placeholder="Date" value="{{ $student->dob }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender :</label>
                                <div class="col-sm-9">
                                    {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], $student->gender, [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('email', $student->user->email, [
                                        'placeholder' => 'Email',
                                        'class' => 'form-control',
                                        'disabled',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nic Number :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('nic', $student->nic, ['placeholder' => 'NIC', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone Number :</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phno" placeholder="Phone number"
                                        value="{{ $student->user->phno }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" placeholder="Address"
                                        value="{{ $student->address }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Select Course :</label>
                                <div class="col-sm-9">
                                    {!! Form::select('courses[]', $availableCourses, $coursesStudyingIds, [
                                        'class' => 'form-control select2',
                                        'multiple',
                                        'name' => 'course_ids[]',
                                        'id' => 'course_ids[]',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password :</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password :</label>
                                <div class="col-sm-9">
                                    <input type="password" name="confirm-password" placeholder="Confirm Password"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection
