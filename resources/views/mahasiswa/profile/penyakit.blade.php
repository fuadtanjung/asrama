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
                <div class="card-header">Riwayat Penyakit</div>
                <div class="card-body p-0">
                    <!-- Billing history table-->
                    <div class="table-responsive table-billing-history">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Penyakit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($penyakit as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_penyakit }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
