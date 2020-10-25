@extends('layouts.app')

@section('navbar')
    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand" href="{{ route('home') }}">Asrama</a>
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i class="fa fa-bars"></i></button>
        <ul class="navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{ url('images/at-work-pana.svg')}}"/></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <a class="dropdown-item" href="{{ route ('login.logout') }}">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route ('home')}}">
                            <div class="nav-link-icon"><i class="fa fa-home"></i></div>
                            Dashboard
                        </a>
                        @if ( auth()->user()->role->nama == "pembina")

                            <div class="sidenav-menu-heading">Data Mahasiswa</div>
                            <a class="nav-link" href="{{ route ('datamahasiswa')}}">
                                <div class="nav-link-icon"><i class="fa fa-table"></i></div>
                                Mahasiswa
                            </a>

                            <a class="nav-link" href="{{ url ('absensholat')}}">
                                <div class="nav-link-icon"><i class="fa fa-table"></i></div>
                                Absen Sholat
                            </a>

                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapsecheckout" aria-expanded="false" aria-controls="collapseDashboards">
                                <div class="nav-link-icon"><i class="fas fa-address-card"></i></div>
                                Kartu Check Out
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsecheckout" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link" href="{{ route('datatugasbulananmahasiswa') }}">
                                        Tugas Bulanan
                                    </a>
                                    <a class="nav-link" href="{{ route('datatagihanmahasiswa') }}">
                                        Tagihan Mahasiswa
                                    </a>
                                    <a class="nav-link" href="{{ route('datadendamahasiswa') }}">
                                        Denda
                                    </a>
                                </nav>
                            </div>

                            <div class="sidenav-menu-heading">Fakultas dan Jurusan</div>
                            <a class="nav-link" href="{{ url ('fakultas')}}">
                                <div class="nav-link-icon"><i class="fa fa-graduation-cap"></i></div>
                                Fakultas
                            </a>
                            <a class="nav-link" href="{{ url ('jurusan')}}">
                                <div class="nav-link-icon"><i class="fa fa-graduation-cap"></i></div>
                                Jurusan
                            </a>

                            <div class="sidenav-menu-heading">Kelola Data</div>
                            <a class="nav-link" href="{{ url ('goldar')}}">
                                <div class="nav-link-icon"><i class="fa fa-user-md"></i></div>
                                Golongan Darah
                            </a>
                            <a class="nav-link" href="{{ url ('jalurmasuk')}}">
                                <div class="nav-link-icon"><i class="fa fa-filter"></i></div>
                                Jalur Masuk
                            </a>
                            <a class="nav-link" href="{{ url ('denda')}}">
                                <div class="nav-link-icon"><i class="fa fa-filter"></i></div>
                                Denda
                            </a>
                            <div class="sidenav-menu-heading">Gedung Asrama</div>
                            <a class="nav-link" href="{{ url ('gedung')}}">
                                <div class="nav-link-icon"><i class="fa fa-building"></i></div>
                                Gedung
                            </a>
                            <a class="nav-link" href="{{ url ('ruangan')}}">
                                <div class="nav-link-icon"><i class="fa fa-bed"></i></div>
                                Ruangan
                            </a>
                            <div class="sidenav-menu-heading">Tugas</div>
                            <a class="nav-link" href="{{ url ('tugas')}}">
                                <div class="nav-link-icon"><i class="fa fa-tasks"></i></div>
                                Tugas
                            </a>
                            <a class="nav-link" href="{{ url ('tugasbulanan')}}">
                                <div class="nav-link-icon"><i class="fa fa-tasks"></i></div>
                                Tugas Bulanan
                            </a>
                            <div class="sidenav-menu-heading">Akun</div>
                            <a class="nav-link" href="{{ url ('akunpembina')}}">
                                <div class="nav-link-icon"><i class="fa fa-tasks"></i></div>
                                Akun Pembina
                            </a>
                        @endif

                        @if ( auth()->user()->role->nama == "mahasiswa" && empty(auth()->user()->mahasiswa)== false)
                            <a class="nav-link" href="{{ url ('mahasiswa')}}">
                                <div class="nav-link-icon"><i class="fa fa-desktop"></i></div>
                                Profile
                            </a>
                            <a class="nav-link" href="{{ url ('riwayatpenyakit')}}">
                                <div class="nav-link-icon"><i class="fa fa-desktop"></i></div>
                                Riwayat Penyakit
                            </a>
                            <a class="nav-link" href="{{ url ('pengalamanorganisasi')}}">
                                <div class="nav-link-icon"><i class="fa fa-desktop"></i></div>
                                Pengalaman Organisasi
                            </a>
                            <a class="nav-link" href="{{ url ('pengalamanorganisasi')}}">
                                <div class="nav-link-icon"><i class="fa fa-desktop"></i></div>
                               Check - IN
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="footer mt-auto footer-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &#xA9; Your Website 2020</div>
                        <div class="col-md-6 text-md-right small">
                            <a href="#!">Privacy Policy</a>
                            &#xB7;
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection

