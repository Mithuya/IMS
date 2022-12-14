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
                    <h4 class="page-title">subjects</h4>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Table</li> --}}
                    </ol>

                </div>
                <div class="col-sm-6">

                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm float-end"><i class="mdi mdi-plus mr-2"></i>Add</a>
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
                                    <th>Tittle</th>
                                    <th>Description</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @if(count($data) > 0)

                                    @foreach($data as $row)

                                        <tr>

                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td>{{ $row->duration }}</td>
                                            <td>
                                                <form method="post" action="{{ route('subjects.destroy', $row->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('subjects.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
                                                    <a href="{{ route('subjects.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <input onclick="return confirm('Sure Want Delete?')" type="submit" class="btn btn-danger btn-sm" value="Delete" />
                                                </form>

                                            </td>
                                        </tr>

                                    @endforeach

                                @else
                                <tr>
                                    <td colspan="5" class="text-center">No Data Found</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                        {!! $data->links() !!}
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
    <!-- container-fluid -->

</div>

@endsection


@push('scripts')
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
