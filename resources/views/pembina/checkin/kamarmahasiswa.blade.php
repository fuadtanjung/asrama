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
                        @php
                        $jml = \App\Mahasiswa_gedung::where('ruangan_id',$data->id)->get();
                        @endphp

                        @if( count($jml) < 4)
                        <td><a class="btn btn-primary-soft" href="{{ route("kamar",$data->id) }}">Tambah Mahasiswa</a></td>

                        @elseif( count($jml) >= 4 )
                            <td><a class="btn btn-primary" href="{{ route('check',$data->id) }}">Lihat Mahasiswa</a></td>
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

