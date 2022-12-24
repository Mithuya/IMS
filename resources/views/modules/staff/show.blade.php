@extends('master')

@section('content')




<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">View Staffs</h4>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
                    </ol>

                </div>
                <div class="col-sm-6">

                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                           <form method="post" action="{{ route('staffs.destroy', $staff->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('staffs.index') }}" class="btn btn-primary btn-sm">View All</a>
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
                        <label class="col-sm-2 col-label-form">Staff Name</label>
                        <div class="col-sm-10">
                            <input disabled type="text" name="name" class="form-control" value="{{ $staff->name }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Date of Birth</label>
                        <div class="col-sm-10">
                            <input disabled type="date" name="date" class="form-control" value="{{ $staff->dob }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Gender</label>
                        <div class="col-sm-10">
                            <input disabled type="text" name="name" class="form-control" value="{{ $staff->gender }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Email</label>
                        <div class="col-sm-10">
                            <input disabled type="email" name="email" class="form-control" value="{{ $staff->email }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">NIC Number</label>
                        <div class="col-sm-10">
                            <input disabled type="text" name="nic" class="form-control" value="{{ $staff->nic }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Phone Number</label>
                        <div class="col-sm-10">
                            <input disabled type="number" name="phno" class="form-control" value="{{ $staff->phno }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Address</label>
                        <div class="col-sm-10">
                            <input disabled type="text" name="address" class="form-control" value="{{ $staff->address }}" />
                        </div>
                    </div>




                </form>
            </div>
        </div>
    </div>
</div>


@endsection('content')
