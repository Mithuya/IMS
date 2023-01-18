@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Users Information</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-1">
                                <div id="ToolbarLeft"></div>
                                <div id="ToolbarCenter"></div>
                                <div class="col-2">
                                    <select class="form-control select2" id="role_id" name="role_id">
                                        <option selected disabled>Select Role</option>
                                        <option value="">All</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="ToolbarRight"></div>
                            </div>
                            <table id="sqltable" class="table table-bordered table-striped table-hover table-sm dataTable">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col" width="4%">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number </th>
                                        <th scope="col">Action </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div>
        <!-- container-fluid -->

    </div>
@endsection

@section('scripts')
    @include('_datatable.datatables-js')

    @parent
    <script>
        $(function() {
            /* ------------------------------------------------------------------------ */
            let dtOverrideGlobals = {
                serverSide: true,
                retrieve: true,
                ajax: {
                    url: "{{ route('users.index') }}",
                    data: function(d) {
                        d.role_id = $('#role_id').val()
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return data.toString().padStart(5, '0');
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'phno',
                        name: 'phno',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        className: "text-center no-select toggleEnterMark",
                        render: function(data, type, row, meta) {

                            return '<a href="users/'+data+'" id="view_user" class="btn btn-primary btn-sm mr-1 view_user">View</a>' +
                                '<a href="users/'+data+'/edit" id="edit_user" class="btn btn-warning btn-sm mr-1 edit_user">Edit</button>' +
                                '<a href="" id="delete_user" class="btn btn-danger btn-sm delete_user">Delete</a>';

                        },
                    }

                ],
                select: {
                    selector: 'td:not(.no-select)',
                },
                ordering: true,
                order: [
                    [1, "asc"]
                ],
                preDrawCallback: function(settings) {
                    oTable.columns.adjust();
                }
            };
            /* ------------------------------------------- */
            let oTable = $('#sqltable').DataTable(dtOverrideGlobals);
            /* ------------------------------------------------------------------------ */
            new $.fn.dataTable.Buttons(oTable, {
                name: 'BtnGroupLeft',
                buttons: dtButtonsLeft
            });
            new $.fn.dataTable.Buttons(oTable, {
                name: 'BtnGroupCenter',
                buttons: dtButtonsCenter
            });
            new $.fn.dataTable.Buttons(oTable, {
                name: 'BtnGroupRight',
                buttons: dtButtonsRight
            });

            oTable.buttons('BtnGroupLeft', null).containers().appendTo('#ToolbarLeft');
            oTable.buttons('BtnGroupCenter', null).containers().appendTo('#ToolbarCenter');
            oTable.buttons('BtnGroupRight', null).containers().appendTo('#ToolbarRight');
            /* ------------------------------------------------------------------------ */
            oTable.on('select deselect', function(e, dt, type, indexes) {
                var selectedRows = oTable.rows({
                    selected: true
                }).count();

                oTable.buttons('.selectOne').enable(selectedRows === 1);
                oTable.buttons('.selectMultiple').enable(selectedRows > 0);
            });


            /* ------------------------------------------------------------------------ */
            /* FUNCTIONS - DropDown       			            		                */
            /* ------------------------------------------------------------------------ */

            $('#role_id').change(function() {
                oTable.draw();
            });
            /* ------------------------------------------------------------------------ */
            /* FUNCTIONS - Action Buttons       			            		                */
            /* ------------------------------------------------------------------------ */

            // $(document).on('click', '.view_user', function() {
            //     var id = oTable.row($(this).closest("tr")).data().id;
            //     $.ajax({
            //         method: 'GET',
            //         url:  '{{ route("users.show", '3') }}'
            //     });
            // });
            // $(document).on('click', '.edit_user', function() {

            //     oTable.draw();
            // });
            $(document).on('click', '.delete_user', function() {

                oTable.draw();
            });
        });
    </script>
@endsection

@section('styles')
    @include('_datatable.datatables-css')
@endsection

@push('scripts')
@endpush
