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
                columns: [
                    {
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
            /* FUNCTIONS - DropDown       			            		    */
            /* ------------------------------------------------------------------------ */

            $('#role_id').change(function() {
                oTable.draw();
            });
            /* ------------------------------------------------------------------------ */

        });
    </script>

@endsection

@section('styles')
    @include('_datatable.datatables-css')
@endsection

@push('scripts')
@endpush
