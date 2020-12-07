@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Kamar</div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Nama Gedung</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ruangan as $data)
                    <tr>
                        <td>{{ $data->nama_ruangan }}</td>
                        <td>{{ $data->nama_gedung }}</td>
                        <td><a class="btn btn-primary" href="{{ route('check',$data->id) }}">Lihat Mahasiswa</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

