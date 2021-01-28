@extends('layouts.navbar')

@section('content')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Profile Pendaftaran
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link ml-0 {{ request()->is('profile/mahasiswa') ? 'active' : ''}}" href="{{ url('profile/mahasiswa') }}">Biodata Mahasiswa</a>
            <a class="nav-link {{ request()->is('profile/keluarga') ? 'active' : ''}}" href="{{ url('profile/keluarga') }}">Biodata Keluarga</a>
            <a class="nav-link {{ request()->is('profile/pengalaman') ? 'active' : ''}}" href="{{ url('profile/pengalaman') }}">Pengalaman Organisasi</a>
            <a class="nav-link {{ request()->is('profile/penyakit') ? 'active' : ''}}" href="{{ url('profile/penyakit') }}">Riwayat Penyakit</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <!-- Change password card-->
        <div class="card">
            <div class="card-header">Biodata Mahasiswa</div>
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nim">Nim</label>
                            <input class="form-control" value="{{ Auth::user()->nim }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->nama }}"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->tempat_lahir }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input class="form-control" value="{{ date('d-m-Y',strtotime( Auth::user()->mahasiswa->tanggal_lahir)) }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kontak">No. Hp</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->no_hp }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->jenis_kelamin }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control">{{ Auth::user()->mahasiswa->alamat }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status Rumah</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->status_rumah->nama_status }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Jalur Masuk</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->jalur_masuk->nama_jalur}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jurusan</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->jurusan->nama_jurusan }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Bidik Misi</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->bidik_misi }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Golongan Darah</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->goldar->nama_goldar }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Asal Sekolah</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->asal_sekolah }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Agama</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->agama }}"/>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Shalat Wajib</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->shalat_wajib }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hafalan Quran</label>
                            <input class="form-control" value="{{ Auth::user()->mahasiswa->hafalan }}"/>
                        </div>
                    </div>
                    <hr class="my-4" />
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
