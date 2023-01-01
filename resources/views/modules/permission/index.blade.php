@extends('master')

@push('styles')
    <!-- DataTables -->
    <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Permissions</h4>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
                    </ol>

                </div>
                <div class="col-sm-6">

                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm float-end"><i class="mdi mdi-plus mr-2"></i>Add</a>
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

                        @if($message = Session::get('success'))

                        <div class="alert alert-success">
                            {{ $message }}
                        </div>

                         @endif


                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Permission</th>
                                    <th>Action</th>
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


@push('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            // DataTable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "getPermissions",    // ajax: "{{route('getPermissions')}}", we can use this also
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    {
                    data: null,
                    className: "",
                    orderable: false,
                    "mRender" : function ( data, type, row ) {

                            return  '<form method="post" action="permissions/'+data.id+'">'+
                                        '@csrf'+
                                        '@method("DELETE")'+
                                        '<a class="btn-view btn btn-primary btn-sm mr-1" href="permissions/'+data.id+'" value="'+data.id+'" >View </a>'+
                                        '<a class="btn-edit btn btn-warning btn-sm mr-1" href="permissions/'+data.id+'/edit" value="'+data.id+'" >Edit </a>'+
                                        '<input onclick="return confirm('Sure Want Delete?')" type="submit" class="btn btn-danger btn-sm" value="Delete" />'+
                                    '</form>'
                            ;
                        }
                    }
                ]
            });

        });

     </script>

    <!-- Required datatable js -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/datatables/jszip.min.js"></script>
    <script src="../plugins/datatables/pdfmake.min.js"></script>
    <script src="../plugins/datatables/vfs_fonts.js"></script>
    <script src="../plugins/datatables/buttons.html5.min.js"></script>
    <script src="../plugins/datatables/buttons.print.min.js"></script>
    <script src="../plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
@endpush
