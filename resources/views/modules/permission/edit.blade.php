@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Permission</h4>
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
                    <form method="post" action="{{ route('permissions.update', $permission->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Post Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ $permission->name }}" />
                                <input hidden type="text" name="guard_name" value="web" class="form-control" />
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="hidden_id" value="{{ $permission->id }}" />
                            <input type="submit" class="btn btn-primary" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
