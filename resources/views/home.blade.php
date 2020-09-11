@extends('layouts.navbar')
@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"></div>
                            <?php   date_default_timezone_set('Asia/Jakarta'); echo date('l, d-m-Y  h:i a'); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-n10">
        <!-- Illustration dashboard card example-->
        <div class="card card-waves mb-4 mt-5">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">Welcome back, your dashboard is ready!</h2>
                        <p class="text-gray-700">Great job, your affiliate dashboard is ready to go! You can view sales, generate links, prepare coupons, and download affiliate reports using this dashboard.</p>
                        <a class="btn btn-primary btn-sm px-3 py-2" href="#!">
                            Get Started
                            <i class="ml-1" data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5" src="{{ url('images/at-work-pana.svg')}}" /></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            @if(Session::has('success'))
            iziToast.success({
                title: 'Berhasil',
                position: 'topRight',
                message: '{{ Session::get('success') }}'
            });
            @endif
        });
    </script>
@endsection
