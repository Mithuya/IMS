@extends('master')

@section('content')

@push('styles')
    <!-- Plugins css -->
    <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet')}}">
    <link href="{{asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet')}}">
    <link href="{{asset('plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css')}}" />
    <link href="{{asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet')}}" />


@endpush


<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Edit User</h4>
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
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', $user->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Date of Birth:</strong>
                            {!! Form::date('dob', $user->date, array('placeholder' => 'Date','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Gender:</strong>
                            {!! Form::text('gender', null, array('placeholder' => 'Gender','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nic Number:</strong>
                            {!! Form::text('nic', null, array('placeholder' => 'NIC','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Phone Number:</strong>
                            {!! Form::number('phno', null, array('placeholder' => 'Phone number','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Address:</strong>
                            {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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


@endsection('content')


@push('scripts')
            <!-- Plugins js -->
            <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
            <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

            <!-- Plugins Init js -->
            <script src="{{asset('assets/pages/form-advanced.js')}}"></script>



@endpush
