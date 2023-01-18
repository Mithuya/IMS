@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Exam Results</h4>
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
                                <div class="col-2">
                                    <select class="form-control select2" id="exam_id" name="exam_id">
                                        <option selected disabled>Select Exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="ToolbarCenter"></div>
                                <div id="ToolbarRight"></div>
                            </div>
                            <table id="sqltable" class="table table-bordered table-striped table-hover table-sm dataTable">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col" width="4%">ID</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Is Present? </th>
                                        <th scope="col">Result </th>
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
                    url: "{{ route('results.index') }}",
                    data: function(d) {
                        d.exam_id = $('#exam_id').val()
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
                        data: 'student_name',
                        name: 'student_name',
                    },
                    {
                        data: 'exam-attendance',
                        name: 'exam-attendance',
                    },
                    {
                        data: 'exam-result',
                        name: 'exam-result',
                    },
                    {
                        data: 'enter_mark',
                        name: 'enter_mark',
                        searchable: false,
                        className: "text-center no-select toggleEnterMark",
                        render: function(data, type, row, meta) {
                            if (data == 1) {
                                return '<i class="bi bi-building-add"> Add Result</i>';
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
            $('#sqltable tbody').on('click', 'td.toggleEnterMark', function() {

                var id = oTable.row($(this).closest("tr")).data().DT_RowId;
                var student_name = oTable.row($(this).closest("tr")).data().student_name;
                var exam_id = $('#exam_id').val();

                let locale = {
                    OK: 'Ok',
                    CONFIRM: 'Add Mark',
                    CANCEL: 'Cancel'
                };

                bootbox.addLocale('custom', locale);

                bootbox.prompt({
                    title: 'Do you want to add result for ' + student_name + ' ?',
                    locale: 'custom',
                    inputType: 'number',
                    min: 0,
                    max: 100,
                    required: true,
                    callback: function(result) {
                        if (result !== null) {
                            setMark(id, exam_id, result);
                        }
                    }
                });
            });

            /* ------------------------------------------- */
            function setMark(id, exam_id, result) {
                $.ajax({
                    method: 'PUT',
                    url: '/results/' + id,
                    data: {
                        student_id: id,
                        exam_id: exam_id,
                        result: result,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.success == true) {
                            // oTable.rows(id).invalidate().draw(false);
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
            };

            /* ------------------------------------------------------------------------ */
            /* FUNCTIONS - DropDown       			            		    */
            /* ------------------------------------------------------------------------ */
            $('#exam_id').change(function() {
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
