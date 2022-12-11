@extends('master')

@section('content')

@push('styles')
    <!-- Plugins css -->
    {{-- <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet')}}">
    <link href="{{asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet')}}">
    <link href="{{asset('plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css')}}" />
    <link href="{{asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet')}}" /> --}}

    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css')}}" />
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
    <script src="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js')}}"></script>
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
                <form method="put" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text"  id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="useremail">User Email</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label">Multiple Select</label>
                        <select class="selectpicker" multiple data-live-search="true">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password"  id="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="userconfirmpassword">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm-password" name="confirm-password"  autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <input type="hidden" name="hidden_id" value="{{ $user->id }}" />
                        <input type="submit" class="btn btn-primary" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection('content')


@push('scripts')
            <!-- Plugins js -->
            {{-- <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
            <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

            <!-- Plugins Init js -->
            <script src="{{asset('assets/pages/form-advanced.js')}}"></script> --}}
@endpush
