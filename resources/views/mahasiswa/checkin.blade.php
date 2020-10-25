@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>NIM</label>
                                <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->nim}}" readonly>
                            </div>
                            <div class="col-sm-5">
                                <label>Nama</label>
                                <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->nama}}" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label>No. Hp</label>
                                <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->no_hp}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->tempat_lahir}}">
                            </div>
                            <div class="col-sm-4">
                                <label> Tanggal Lahir</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ date('d-m-Y',strtotime( auth()->user()->mahasiswa->tanggal_lahir))}}">
                            </div>
                            <div class="col-sm-4">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->jenis_kelamin}}">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Jurusan</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->jurusan->nama_jurusan}}">
                            </div>
                            <div class="col-sm-3">
                                <label>Status Rumah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->status_rumah->nama_status}}">
                            </div>
                            <div class="col-sm-3" id="tanggal">
                                <label>Jalur Masuk</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->jalur_masuk->nama_jalur}}">
                            </div>
                            <div class="col-sm-3" id="tanggal">
                                <label>Golongan Darah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->goldar->nama_goldar}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Alamat</label>
                                <textarea class="form-control  form-control-solid form-control-sm">{{ auth()->user()->mahasiswa->alamat}}</textarea>
                            </div>
                            <div class="col-sm-2">
                                <label>Bidik Misi</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->bidik_misi}}">
                            </div>
                            <div class="col-sm-5">
                                <label>Asal Sekolah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->asal_sekolah}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Agama</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->agama}}">
                            </div>
                            <div class="col-sm-4">
                                <label>Shalat Wajib</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->shalat_wajib}}">
                            </div>
                            <div class="col-sm-4">
                                <label>Hafalan Quran</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->hafalan}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nama Ayah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->nama_ayah}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->nama_ibu}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Pekerjaan Ayah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->pekerjaan_ayah}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Pekerjaan Ibu</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->pekerjaan_ibu}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Pendapatan Ayah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->pendapatan_ayah}}">
                            </div>
                            <div class="col-sm-6">
                                <label>Pekerjaan Ibu</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->pendapatan_ibu}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>No. Hp Orang Tua</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->no_hp_ortu}}">
                            </div>
                            <div class="col-sm-4">
                                <label>Anak Ke</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->anak_ke}}">
                            </div>
                            <div class="col-sm-4">
                                <label>Jumlah Saudara</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->mahasiswa->total_saudara}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
