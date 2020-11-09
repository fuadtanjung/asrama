@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Tugas</div>
            <div class="card-body">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Tugas</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach( $tugas as $data )
                            <td>{{ $data->nama_tugas }}</td>
                            <td>{{ $data->bulan }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>{{ $data->keterangan }}</td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
@endsection
