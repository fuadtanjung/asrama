@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <form action="{{ route('masuk',$id) }}" method="post">
                @csrf
            <div class="card-header">Denda</div>
            <br>
            <div class="container-sm">
                <button type="submit" class="btn btn-primary btn-sm legitRipple">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mahasiswa as $data)
                        <tr>
                            <td>{{ $data->nama }}</td>
                            <td><input type="checkbox" value="{{ $data->user_id }}" name="mahasiswa_id"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
@endsection


