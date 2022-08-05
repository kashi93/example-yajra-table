@extends('template.app')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="user-table">
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Post Count</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection


@section('script')
<script src="{{asset('sb-admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('user.data.table') !!}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'post_count',
                    name: 'post_count'
                }
            ]
        });
    });
</script>
@endsection

@section('style')
<!-- Custom styles for this page -->
<link href="{{asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection