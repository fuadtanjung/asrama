@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Tugas</div>
            <div class="card-body">
                <table class="table table-hover table-green-soft table-sm table-bordered" id="table">
                    <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama Tugas</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach( $tugas as $data )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_tugas }}</td>
                        <td>{{ $data->bulan }}</td>
                        <td>{{ $data->tahun }}</td>
                        <td>{{ $data->keterangan }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
@endsection
