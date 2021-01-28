@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Arsip Mahasiswa</h1>
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
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Fakultas</th>
                        <th>Jurusan</th>
                        <th>No.Hp</th>
                        <th>Jeni Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat Rumah</th>
                        <th>Status Rumah</th>
                        <th>Jalur Masuk</th>
                        <th>Bidik Misi</th>
                        <th>Asal Sekolah</th>
                        <th>Golongan Darah</th>
                        <th>Agama</th>
                        <th>Shalat</th>
                        <th>Shalat</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Pekerjaan Ibu</th>
                        <th>Pendapatan Ayah</th>
                        <th>Pendapatan Ibu</th>
                        <th>No Hp Orang Tua</th>
                        <th>Anak ke</th>
                        <th>Jumlah Saudara</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center" >
                    @foreach($mahasiswa as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a -> nim }}</td>
                            <td>{{ $a -> nama }}</td>
                            <td>{{ $a -> jurusan->fakultas->nama_fakultas }}</td>
                            <td>{{ $a -> jurusan->nama_jurusan }}</td>
                            <td>{{ $a -> no_hp }}</td>
                            <td>{{ $a -> jenis_kelamin }}</td>
                            <td>{{ $a -> tanggal_lahir }}</td>
                            <td>{{ $a -> alamat }}</td>
                            <td>{{ $a -> status_rumah->nama_status }}</td>
                            <td>{{ $a -> jalur_masuk->nama_jalur }}</td>
                            <td>{{ $a -> bidik_misi }}</td>
                            <td>{{ $a -> asal_sekolah }}</td>
                            <td>{{ $a -> goldar->nama_goldar }}</td>
                            <td>{{ $a -> agama }}</td>
                            <td>{{ $a -> shalat_wajib }}</td>
                            <td>{{ $a -> hafalan }}</td>
                            <td>{{ $a -> nama_ayah }}</td>
                            <td>{{ $a -> nama_ibu }}</td>
                            <td>{{ $a -> pekerjaan_ayah}}</td>
                            <td>{{ $a -> pekerjaan_ibu }}</td>
                            <td>{{ $a -> pendapatan_ayah }}</td>
                            <td>{{ $a -> pendapatan_ibu }}</td>
                            <td>{{ $a -> no_hp_ortu }}</td>
                            <td>{{ $a -> anak_ke }}</td>
                            <td>{{ $a -> total_saudara }}</td>
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
                    $('#datatable').DataTable({
                        "scrollX": true,  dom: 'Bfrtip',
                        buttons: [
                            'excel'
                        ]
                    });
                } );
            </script>
@endsection
