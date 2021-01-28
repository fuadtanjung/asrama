@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Data Mahasiswa</h1>
            </div>
            <!-- Date range picker example button-->
            <div class="btn btn-white btn-sm line-height-normal p-3" >
                <span>
                <h5>Total Mahasiswa :  <strong class="text-danger">{{ $mahasiswa->count() }}</strong> Orang </h5>
                    </span>
            </div>
        </div>
    </div>
    <div class="container mt-1">

        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-green-soft table-bordered table-sm" id="datatable">
                    <thead style="text-align: center">
                    <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center" >
                    @foreach($mahasiswa as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a -> nim }}</td>
                            <td>{{ $a -> nama }}</td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm legitRipple" href="{{ route('denda',[$a -> user_id]) }}"><i class="fa fa-wrench" style="margin-right: 7px"></i>Denda</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

