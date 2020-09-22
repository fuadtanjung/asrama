@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Data Mahasiswa</h1>
                <div class="small">
                    <span class="font-weight-500 text-primary">Kelola Mahasiswa : </span>
                    Seperti Detail Mahasiswa,Tugas Bulanan,Tagihan Mahasiswa, dan Denda Mahasiswa
                </div>
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
                <table class="table table-hover table-bordered table-sm" id="datatable">
                    <thead style="text-align: center">
                    <tr>
                        <th >No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th></th>
                    </tr>
                    </thead>
                        <tbody style="text-align: center" >
                        @foreach($mahasiswa as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a -> nim }}</td>
                            <td>{{ $a -> nama }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-teal dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                                    <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                        <a class="dropdown-item" href="{{ route('detailmahasiswa',[$a -> user_id]) }}">Detail</a>
                                        <a class="dropdown-item" href="{{ route('tugasbulanan',[$a -> user_id]) }}">Tugas Bulanan</a>
                                        <a class="dropdown-item" href="{{ route('tagihanmahasiswa',[$a -> user_id]) }}">Tagihan Mahasiswa </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
@endsection

@section('script')
    <script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
    </script>
@endsection
