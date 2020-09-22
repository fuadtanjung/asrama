@extends('layouts.navbar')

@section('content')
    <div class="container mt-4">
    <div class="row">
        <div class="col-xl-6">
            <!-- Profile picture card-->
            @foreach($detailmahasiswa as $b)
            <div class="card">
                <div class="card-header">Pengalaman Organisasi</div>
                <div class="card-body">
                    <!-- Profile picture image-->
                   <table>
                       <thead class="table table-bordered">
                       <tr>
                       <th>Nama Organisasi</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
{{--                           <td>{{ $b->pengalaman_organisasi->nama_organisasi}}</td>--}}
                       </tr>
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">Profile Mahasiswa</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                        <label>NIM</label>
                                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ $b->nim }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Nama</label>
                                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ $b->nama}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>No. Hp</label>
                                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ $b->no_hp}}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Jenis Kelamin</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{$b->jenis_kelamin}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Tempat Lahir</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->tempat_lahir}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label> Tanggal Lahir</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ date('d-m-Y',strtotime( $b->tanggal_lahir))}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Jurusan</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->jurusan->nama_jurusan}}">
                                    </div>
                                    <div class="col-sm-6" id="tanggal">
                                        <label>Jalur Masuk</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->jalur_masuk->nama_jalur}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Status Rumah</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->status_rumah->nama_status}}">
                                    </div>

                                    <div class="col-sm-6" id="tanggal">
                                        <label>Golongan Darah</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->goldar->nama_goldar}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Alamat</label>
                                        <textarea class="form-control  form-control-solid form-control-sm">{{ $b->alamat}}</textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Asal Sekolah</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->asal_sekolah}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Agama</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->agama}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Bidik Misi</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->bidik_misi}}">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <label>Shalat Wajib</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->shalat_wajib}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Hafalan Quran</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->hafalan}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Nama Ayah</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->nama_ayah}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Nama Ibu</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->nama_ibu}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Pekerjaan Ayah</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->pekerjaan_ayah}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Pekerjaan Ibu</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->pekerjaan_ibu}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Pendapatan Ayah</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->pendapatan_ayah}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Pekerjaan Ibu</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->pendapatan_ibu}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>No. Hp Orang Tua</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->no_hp_ortu}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Anak Ke</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->anak_ke}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Jumlah Saudara</label>
                                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ $b->total_saudara}}">
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
