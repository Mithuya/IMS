@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">View Users</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <form method="post" action="{{ route('users.destroy', $user->user->id) }}">
                                    @csrf
                                    @can('user-list')
                                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">View All</a>
                                    @endcan
                                    @can('user-edit')
                                        <a href="{{ route('users.edit', $user->user->id) }}"
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
                            <label class="col-sm-2 col-label-form">Name</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="name" class="form-control"
                                    value="{{ $user->user->name }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Date of Birth</label>
                            <div class="col-sm-10">
                                <input disabled type="date" name="date" class="form-control"
                                    value="{{ $user->dob }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Gender</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="name" class="form-control"
                                    value="{{ $user->gender }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Email</label>
                            <div class="col-sm-10">
                                <input disabled type="email" name="email" class="form-control"
                                    value="{{ $user->user->email }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">NIC Number</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="nic" class="form-control"
                                    value="{{ $user->nic }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Phone Number</label>
                            <div class="col-sm-10">
                                <input disabled type="number" name="phno" class="form-control"
                                    value="{{ $user->user->phno }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Address</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="address" class="form-control"
                                    value="{{ $user->address }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Roles : </label>
                            <div class="col-sm-10">
                                @if (!empty($user->user->getRoleNames()))
                                    @foreach ($user->user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @else
                                    <label class="badge badge-info"> Null </label>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
