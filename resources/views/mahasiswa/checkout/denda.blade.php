@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Denda</div>
            <div class="card-body">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Denda</th>
                        <th>Jumlah Denda</th>
                        <th>Keterangan</th>
                        <th>Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach( $denda as $data )
                            <td>{{ $data->nama_denda }}</td>
                            <td>{{ $data->denda }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>{{ date('d-m-Y',strtotime( $data->waktu)) }}</td>
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
