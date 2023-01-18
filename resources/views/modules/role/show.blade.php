@extends('master')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">View Courses</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">

                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <form method="post" action="{{ route('roles.destroy', $role->id) }}">
                                    @csrf
                                    @can('role-list')
                                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">View All</a>
                                    @endcan
                                    @can('role-edit')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            @if (!empty($rolePermissions))
                                @foreach ($rolePermissions as $v)
                                    <label class="label label-success">{{ $v->name }},</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection('content')
