@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Akun Pembina</div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

            $('#datatable').dataTable({
                "ajax": "{{ url('/akunpembina/data') }}",
                "columns": [
                    { "data": "nim" },
                    { "data": "name" },
                    {
                        render: function() {
                            return '<a href="#" id="edit" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-edit"></i> Edit</a> &nbsp' +
                                '<a href="#" id="delete" class="btn btn-outline-danger btn-sm legitRipple"><i class="fa fa-trash"></i> Hapus</a>'
                        }
                    }
                ],
                columnDefs: [
                    {
                        width: "20px",
                        targets: [0]
                    },
                    {
                        width: "20px",
                        targets: [1]
                    },
                    {
                        width: "20px",
                        targets: [2]
                    },
                ],
            });

    </script>
@endsection
