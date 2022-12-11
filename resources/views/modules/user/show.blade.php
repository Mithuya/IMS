@extends('master')

@section('content')




<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">View Users</h4>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
                    </ol>

                </div>
                <div class="col-sm-6">

                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">View All</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
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
                            <input disabled type="text" name="name" class="form-control" value="{{ $user->name }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Email</label>
                        <div class="col-sm-10">
                            <input disabled type="email" name="email" class="form-control" value="{{ $user->email }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-label-form">Roles : </label>
                        <div class="col-sm-10">

                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
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
