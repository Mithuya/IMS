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
                    <h4 class="page-title">Change Password</h4>
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
        {{-- @if($errors->any())

        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach
            </ul>
        </div>

        @endif --}}

        <div class="card">

            <div class="card-body">
                <div class="row">
                    <form class="form-horizontal m-t-30" method="POST" action="{{ route('change-password') }}">
                        @csrf
                        <div class="row col-12 form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password"  id="old_password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"  autocomplete="old_password">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row col-12 form-group">
                            <label for="new_password">New Password</label>
                            <input type="password"  id="new_password" class="form-control @error('new_password') is-invalid @enderror" name="new_password"  autocomplete="new_password">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row col-12 form-group">
                            <label for="userconfirmpassword">Confirm New Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation"  autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
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
