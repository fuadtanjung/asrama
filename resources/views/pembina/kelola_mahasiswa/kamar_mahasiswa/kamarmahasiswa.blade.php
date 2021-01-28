@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Kamar</div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-bordered table-green-soft table-sm" id="datatable">
                    <thead class="text-center">
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($ruangan as $data)
                    <tr>
                        <td>{{ $data->nama_ruangan }}</td>
                        <td><a class="btn btn-outline-primary btn-sm legitRipple" href="{{ route('check',$data->id) }}"><i class="fa fa-eye" style="margin-right: 7px"></i>Lihat Mahasiswa</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
@endsection

