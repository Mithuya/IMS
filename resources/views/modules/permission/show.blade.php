@extends('master')

@section('content')




<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">View Permission</h4>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
                    </ol>

                </div>
                <div class="col-sm-6">

                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <form method="post" action="{{ route('permissions.destroy', $permission->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm">View All</a>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
                        <label class="col-sm-2 col-label-form">Permission Name</label>
                        <div class="col-sm-10">
                            <input disabled type="text" name="name" class="form-control" value="{{ $permission->name }}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection('content')
