@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Tagihan</div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft table-bordered" id="datatable">
                    <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach( $tagihan as $data )
                            <td>{{ $data->bulan }}</td>
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
