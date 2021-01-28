@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <form>
                <div class="card-body" style="margin-right: 10%">
                    <table class="table table-hover table-green-soft" id="datatable">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Bulan</th>
                            <th>keterangan</th>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($namamahasiswa as $data)
                            <tr>
                                <td>{{ $loop-> iteration }}</td>
                                <td>{{ $data-> bulan }}</td>
                                <td>{{ $data-> keterangan }}</td>
                                <td><a class="btn btn-outline-primary btn-sm legitRipple"  href="{{ route('unduhbukti',[$data->mahasiswa_id,$data->bulan]) }}">Bukti</a></td>
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
                message: "Bukti Tagihan Mahasiswa Belum Diupload",
                timeout :'2500',
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX'
            });
            @endif
        } );
    </script>
@endsection


