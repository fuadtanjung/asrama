@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 80%">
            <div class="card-header">Tagihan</div>
            <div class="card-body" style="margin-right: 5%">
                <table class="table table-hover table-sm table-bordered table-green-soft table-bordered" id="table">
                    <thead class="text-center">
                    <tr>
                        <th>Bulan</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $tagihan as $data )
                    <tr>
                        <td>{{ $data->bulan }}</td>
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
