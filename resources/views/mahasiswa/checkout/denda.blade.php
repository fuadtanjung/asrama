@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Denda</div>
            <div class="card-body">
                <table class="table table-hover table-sm table-bordered table-green-soft" id="table">
                    <thead class="text-center">
                    <tr>
                        <th>Nama Denda</th>
                        <th>Jumlah Denda</th>
                        <th>Keterangan</th>
                        <th>Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $denda as $data )
                    <tr>
                    <td>{{ $data->nama_denda }}</td>
                    <td>{{ $data->denda }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ date('d-m-Y',strtotime( $data->waktu)) }}</td>
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
        });
    </script>
@endsection
