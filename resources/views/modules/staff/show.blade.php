@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">View staffs</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <form method="post" action="{{ route('staffs.destroy', $staff->id) }}">
                                    @csrf
                                    @can('staff-list')
                                        <a href="{{ route('staffs.index') }}" class="btn btn-primary btn-sm">View All</a>
                                    @endcan
                                    @can('staff-edit')
                                        <a href="{{ route('staffs.edit', $staff->id) }}"
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
                    {!! Form::open() !!}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Name :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('name', $staff->user->name, ['placeholder' => 'Name', 'class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label for="example-name-input" class="col-sm-3 col-form-label">Date of Birth :</label>
                                <div class="col-sm-9">
                                    {!! Form::date('dob', $staff->dob, ['placeholder' => 'Date', 'class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender :</label>
                                <div class="col-sm-9">
                                    {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], $staff->gender, [
                                        'class' => 'form-control',
                                        'disabled',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('email', $staff->user->email, [
                                        'placeholder' => 'Email',
                                        'class' => 'form-control',
                                        'disabled',
                                        'disabled',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nic Number :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('nic', $staff->nic, ['placeholder' => 'NIC', 'class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone Number :</label>
                                <div class="col-sm-9">
                                    {!! Form::number('phno', $staff->user->phno, [
                                        'placeholder' => 'Phone number',
                                        'class' => 'form-control',
                                        'disabled',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address :</label>
                                <div class="col-sm-9">
                                    {!! Form::text('address', $staff->address, ['placeholder' => 'Address', 'class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Subjects :</label>
                                <div class="col-sm-9">
                                    {!! Form::select('subjects[]', $availableSubjects, $subjectsTeachingIds, [
                                        'class' => 'form-control select2',
                                        'multiple',
                                        'name' => 'subject_ids[]',
                                        'id' => 'subject_ids[]',
                                        'disabled',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection('content')
