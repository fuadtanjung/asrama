@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <form>
                <div class="card-body" style="margin-right: 10%">
                    <table class="table table-hover table-green-soft table-bordered table-sm" id="datatable">
                        <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($checkroom as $data)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $data->nama }}</td>
                                <td><a class="btn btn-outline-primary btn-sm legitRipple" href="{{ route('unduh',[$data->ruangan_id,$data->mahasiswa_id]) }}"><i class="fa fa-download" style="margin-right: 7px"></i>Surat Perjanjian</a></td>
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

            @if(Session::has('failed'))
                iziToast.error({
                title: 'Gagal',
                position: 'topRight',
                message: "Surat Perjanjian Mahasiswa Belum Diupload",
                timeout :'2500',
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX'
                });
            @endif
        } );
    </script>
@endsection


