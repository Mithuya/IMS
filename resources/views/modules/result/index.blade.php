@extends('master')

@push('styles')
@endpush

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
                                {{-- <div id="ToolbarCenter"></div> --}}
                                <div class="col-2">
                                    <select class="form-control select2" id="course_id" name="course_id">
                                        <option selected disabled>Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control select2" id="exam_id" name="exam_id">
                                        <option value="" disabled selected>Select Exam</option>
                                    </select>
                                </div>
                                <div id="ToolbarRight"></div>
                            </div>
                            <table id="sqltable" class="table table-bordered table-striped table-hover table-sm dataTable">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col" width="4%">ID</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Attendance ? </th>
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

            let presentButton = {
                extend: 'selected',
                className: 'btn-info selectMultiple',
                text: '<i class="bi bi-clipboard2-check">Mark Present</i>',
                titleAttr: 'Mark Present',
                enabled: false,
                url: "{{ route('mass-present') }}",
                action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).data(), function(entry) {
                        return entry.id;
                    });

                    bootbox.confirm({
                        title: 'Mark Present for student(s) ...',
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
                                        exam_id: $('#exam_id').val(),
                                        _method: 'Post',
                                        _token: "{{ csrf_token() }}",

                                    },
                                    success: function(response) {
                                        oTable.draw();

                                        showToast({
                                            type: 'success',
                                            title: 'Presents ...',
                                            message: 'The Attendance is marked.',
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
            }
            dtButtonsRight.push(presentButton)

            let unPresentButton = {
                extend: 'selected',
                className: 'btn-warning selectMultiple',
                text: '<i class="bi bi-clipboard2-x-fill">Mark As Unpresent</i>',
                titleAttr: 'Mark Present',
                enabled: false,
                url: "{{ route('mass-unpresent') }}",
                action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).data(), function(entry) {
                        return entry.id;
                    });


                    bootbox.confirm({
                        title: 'Mark Unpresent for student(s) ...',
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
                                        exam_id: $('#exam_id').val(),
                                        _method: 'Post',
                                        _token: "{{ csrf_token() }}",

                                    },
                                    success: function(response) {
                                        oTable.draw();

                                        showToast({
                                            type: 'success',
                                            title: 'Unpresent ...',
                                            message: 'Marked as unPresent.',
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
            }
            dtButtonsRight.push(unPresentButton)

            /* ------------------------------------------------------------------------ */
            let dtOverrideGlobals = {
                serverSide: true,
                retrieve: true,
                ajax: {
                    url: "{{ route('exam-attendances.index') }}",
                    data: function(d) {
                        d.course_id = $('#course_id').val()
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
                        data: 'attendance',
                        name: 'attendance',
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
            /* FUNCTIONS - DropDown       			            		    */
            /* ------------------------------------------------------------------------ */
            $('#course_id').change(function() {
                $('#exam_id').val('');
                oTable.draw();
            });
            $('#exam_id').change(function() {
                oTable.draw();
            });
            /* ------------------------------------------------------------------------ */

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#course_id').on('change', function() {
                var idCourse = this.value;
                $("#exam_id").html('');
                $.ajax({
                    url: "{{ url('fetch-exams') }}",
                    type: "POST",
                    data: {
                        course_id: idCourse,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#exam_id').html(
                            '<option value="" disabled selected>Select Exam</option>');
                        $.each(result.exams, function(key, value) {
                            $("#exam_id").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
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
