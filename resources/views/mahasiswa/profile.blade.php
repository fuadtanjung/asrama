@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Example Card</div>
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
                                <input type="text" class="form-control form-control-solid form-control-sm" value="" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label>No. Hp</label>
                                <input type="text" class="form-control form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-4">
                                <label> Tanggal Lahir</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-4">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Jurusan</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-3">
                                <label>Status Rumah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-3" id="tanggal">
                                <label>Jalur Masuk</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-3" id="tanggal">
                                <label>Golongan Darah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Alamat</label>
                                <textarea class="form-control  form-control-solid form-control-sm"></textarea>
                            </div>
                            <div class="col-sm-2">
                                <label>Bidik Misi</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-5">
                                <label>Asal Sekolah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Agama</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-4">
                                <label>Shalat Wajib</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-4">
                                <label>Hafalan Quran</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nama Ayah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-6">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Pekerjaan Ayah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-6">
                                <label>Pekerjaan Ibu</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Pendapatan Ayah</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-6">
                                <label>Pekerjaan Ibu</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>No. Hp Orang Tua</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-4">
                                <label>Anak Ke</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                            <div class="col-sm-4">
                                <label>Jumlah Saudara</label>
                                <input type="text" class="form-control  form-control-solid form-control-sm" value="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
