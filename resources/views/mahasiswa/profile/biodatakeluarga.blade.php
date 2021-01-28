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
            <div class="card">
                <div class="card-header">Biodata Keluarga</div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Ayah</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->nama_ayah }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->mahasiswa->nama_ibu }}"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Pekerjaan Ayah</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->pekerjaan_ayah }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pekerjaan Ibu</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->pekerjaan_ibu }}"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Pendapatan Ayah</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->pendapatan_ayah }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pendapatan Ibu</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->pendapatan_ibu }}"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>No. Hp Orang Tua</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->no_hp_ortu }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Anak Ke</label>
                                <input class="form-control"  value="{{ Auth::user()->mahasiswa->anak_ke }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jumlah Saudara</label>
                                <input class="form-control" value="{{ Auth::user()->mahasiswa->total_saudara}}"/>
                            </div>
                        </div>
                        <hr class="my-4" />
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
