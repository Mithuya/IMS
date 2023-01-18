@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Roles Information</h4>
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
                                <div id="ToolbarRight">
                                    @can('role-create')
                                        <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm float-end"><i
                                                class="mdi mdi-plus mr-2"></i>Add</a>
                                    @endcan
                                </div>
                            </div>
                            <table id="sqltable" class="table table-bordered table-striped table-hover table-sm dataTable">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col" width="4%">Role ID</th>
                                        <th scope="col">Name</th>
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
                    url: "{{ route('roles.index') }}",
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
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        className: "text-center no-select toggleEnterMark",
                        render: function(data, type, row, meta) {

                            return '@can("role-show") <a href="roles/' + data +
                                '" id="view_role" class="btn btn-primary btn-sm mr-1 view_role">View</a> @endcan' +
                                '@can("role-edit") <a href="roles/' + data +
                                '/edit" id="edit_role" class="btn btn-warning btn-sm mr-1 edit_role">Edit</a> @endcan' +
                                '@can("role-delete") <button id="delete_role" class="btn btn-danger btn-sm delete_role">Delete</button> @endcan';
                        },
                    }

                ],
                select: {
                    selector: 'td:not(.no-select)',
                },
                ordering: true,
                order: [
                    [1, "desc"]
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

            $(document).on('click', '.delete_role', function() {
                var id = oTable.row($(this).closest("tr")).data().id;
                bootbox.confirm({
                    closeButton: false,
                    message: 'Do you Want to delete this Role?',
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $.ajax({
                                method: 'DELETE',
                                url: '/roles/' + id,
                                data: {
                                    id: id,
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    if (response.success == true) {
                                        showToast({
                                            type: 'success',
                                            title: 'Success',
                                            message: response.message,
                                        });
                                        oTable.draw();
                                    } else {
                                        showToast({
                                            type: 'error',
                                            title: 'Error',
                                            message: 'Something Error Happened!',
                                        });
                                    }
                                }
                            });
                            oTable.draw();
                        }
                    }
                });

            });
        });
    </script>
@endsection

@section('styles')
    @include('_datatable.datatables-css')
@endsection

@push('scripts')
@endpush
