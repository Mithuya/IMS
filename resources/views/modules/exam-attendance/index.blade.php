@extends('master')

@push('styles')

@endpush


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Student Attendances</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                    <div class="col-sm-6">

                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('exam-attendances.create') }}" class="btn btn-success btn-sm float-end"><i
                                        class="mdi mdi-plus mr-2"></i>Add</a>
                            </div>
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
                                <div id="ToolbarRight"></div>
                            </div>
                            <table id="sqltable" class="table table-bordered table-striped table-hover table-sm dataTable">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col" width="4%">ID</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Exams of Student</th>
                                        <th scope="col">Writtens Exams</th>
                                        <th scope="col" class="text-danger">Attendance ?</th>
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
            let createButton = {
                className: 'btn-success',
                text: '<i class="bi bi-plus"></i>',
                titleAttr: 'Add',
                enabled: true,
                action: function(e, dt, node, config) {
                    var url = '{{ route('exam-attendances.create') }}';

                    document.location.href = url;
                }
            }
            dtButtonsCenter.push(createButton)

            let showButton = {
                extend: 'selectedSingle',
                className: 'btn-secondary selectOne',
                text: '<i class="bi bi-eye"></i>',
                titleAttr: 'Show',
                enabled: false,
                action: function(e, dt, node, config) {
                    var id = dt.row({
                        selected: true
                    }).data().id;

                    var url = '{{ route('exam-attendances.show', 'id') }}';
                    url = url.replace("id", id);

                    document.location.href = url;
                }
            }
            dtButtonsCenter.push(showButton)

            let editButton = {
                extend: 'selectedSingle',
                className: 'btn-primary selectOne',
                text: '<i class="bi bi-pencil"></i>',
                titleAttr: 'Edit',
                enabled: false,
                action: function(e, dt, node, config) {
                    var id = dt.row({
                        selected: true
                    }).data().id;

                    var url = '{{ route('exam-attendances.edit', 'id') }}';
                    url = url.replace("id", id);

                    document.location.href = url;
                }
            }
            dtButtonsCenter.push(editButton)

            let clearButton = {
                className: 'btn-secondary',
                text: '<i class="bi bi-arrow-counterclockwise"></i>',
                titleAttr: 'Remove filter and sort',
                action: function(e, dt, node, config) {
                    dt.state.clear();
                    window.location.reload();
                }
            }
            dtButtonsRight.push(clearButton)

            let attendanceButton = {
                extend: 'selected',
                className: 'btn-info selectMultiple',
                text: '<i class="bi bi-calendar-check">Mass attendance</i>',
                titleAttr: 'mass attendance',
                enabled: false,
                url: "{{ route('exam-attendances.massAttendance') }}",
                action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).data(), function(entry) {
                        return entry.id;
                    });

                    if (ids.length === 0) {
                        bootbox.alert({
                            title: 'Error ...',
                            message: 'Nothing slected'
                        });
                        return
                    }

                    bootbox.confirm({
                        title: 'Mark Attendance',
                        message: "Are you sure?",
                        buttons: {
                            confirm: {
                                label: 'Yes',
                                className: 'btn-sm btn-primary'
                            },
                            cancel: {
                                label: 'No',
                                className: 'btn-sm btn-secondary'
                            }
                        },
                        callback: function(confirmed) {
                            if (confirmed) {
                                $.ajax({
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'Post'
                                    },
                                    success: function(response) {
                                        oTable.draw();

                                        showToast({
                                            type: 'success',
                                            title: 'Marking ...',
                                            message: 'Present Marked',
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
            }
            dtButtonsRight.push(attendanceButton)
            /* ------------------------------------------------------------------------ */
            let dtOverrideGlobals = {
                serverSide: true,
                retrieve: true,
                ajax: {
                    url: "{{ route('exam-attendances.index') }}",
                    data: function(d) {}
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
                        data: 'student',
                        name: 'student',
                    },
                    {
                        data: 'exams_of_student',
                        name: 'exams_of_student',
                    },
                    {
                        data: 'writtens_exam',
                        name: 'writtens_exam',
                    },
                    {
                        data: 'is_present',
                        name: 'is_present',
                        searchable: false,
                        className: "text-center no-select toggleSendNewsletter",
                        render: function(data, type, row, meta) {
                            if (data == 1) {
                                return '<i class="bi bi-check-lg"></i>';
                            } else {
                                return '&nbsp;';
                            }
                        },
                    }
                ],
                select: {
                    selector: 'td:not(.no-select)',
                },
                ordering: true,
                order: [
                    [1, "asc"],
                    [2, "asc"],
                    [3, "asc"],
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
            /* DATATABLE - CELL - Action					   						    */
            /* ------------------------------------------------------------------------ */
            $('#sqltable tbody').on('click', 'td.toggleSendNewsletter', function() {
                var table = 'customers';
                var id = oTable.row($(this).closest("tr")).data().DT_RowId;
                var key = 'send_newsletter';
                var value = oTable.cell(this).data();

                bootbox.confirm({
                    title: 'Edit ...',
                    message: MyItem(id, key, value),
                    size: 'xl',
                    onEscape: true,
                    backdrop: true,
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-secondary'
                        }
                    },
                    callback: function(confirmed) {
                        if (confirmed) {
                            value = value == 0 ? 1 : 0;

                            setValue(table, id, key, value);
                        }
                    }
                });
            });
            /* ------------------------------------------------------------------------ */
            /* FUNCTIONS - MyItem, setValue         			            		    */
            /* ------------------------------------------------------------------------ */
            function MyItem(id, key, value) {
                var aRow = oTable.row('#' + id).data();

                if (value == 1) {
                    from = '1';
                    to = '0';
                } else {
                    from = '0';
                    to = '1';
                }

                var strHTML = '';
                strHTML += '<table class="table table-bordered table-sm mytable">';
                strHTML += '<thead class="table-success">';
                strHTML +=
                    '<tr><th class="text-center">ID</th><th>Customer</th><th>Company</th><th>Place</th><th class="text-center">Send newsletter ?</th></tr>';
                strHTML += '</thead>';
                strHTML += '<tbody>';
                strHTML += '<tr>';
                strHTML += '<td class="text-center">' + aRow['id'].toString().padStart(5, '0') + '</td>';
                strHTML += '<td>';
                if (aRow['customer'] == null) {
                    strHTML += '&nbsp;';
                } else {
                    strHTML += aRow['customer'];
                }
                strHTML += '</td>';
                strHTML += '<td>';
                if (aRow['company_name'] == null) {
                    strHTML += '&nbsp;';
                } else {
                    strHTML += aRow['company_name'];
                }
                strHTML += '</td>';
                strHTML += '<td>';
                if (aRow['place'] == null) {
                    strHTML += '&nbsp;';
                } else {
                    strHTML += aRow['place'];
                }
                strHTML += '</td>';
                strHTML += '<td class="text-center">';
                strHTML += from + ' <i class="bi bi-arrow-right"></i> ' + to;
                strHTML += '</td>';
                strHTML += '</tr>';
                strHTML += '</tbody>';
                strHTML += '</table>';
                strHTML += '<div>Do you want to mark present for this student?</div>';
                return strHTML;
            };
            /* ------------------------------------------- */
            function setValue(table, id, key, value) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('general.setValueDB') }}",
                    data: {
                        table: table,
                        id: id,
                        key: key,
                        value: value,
                    },
                    success: function(response) {
                        oTable.rows(id).invalidate().draw(false);

                        showToast(response);
                    }
                });
            };
            /* ------------------------------------------------------------------------ */
        });
    </script>
@endsection

@section('styles')
    @include('_datatable.datatables-css')
@endsection

@push('scripts')

@endpush

