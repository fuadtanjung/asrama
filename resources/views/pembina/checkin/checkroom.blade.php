@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <form>
                <div class="card-body" style="margin-right: 10%">
                    <table class="table table-hover table-green-soft" id="datatable">
                        <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($checkroom as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td><a class="btn btn-primary" href="{{ route('unduh',[$data->ruangan_id,$data->mahasiswa_id]) }}">Surat Perjanjian</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </form>
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


