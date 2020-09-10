<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/izitoast/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/custom-styles.css') }}" rel="stylesheet" />

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/izitoast/js/iziToast.min.js') }}"></script>
</head>
<body>
    <br><br><br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card-group">
                    <div class="card p-4">
                            <form action="{{ route('login.postlogin') }}" method="POST">
                                <div class="text-center">
                                    <h2>Log In</h2> <br>
                                </div>
                                @csrf
                                @if(session('errors'))
                                    <div class="alert alert-danger" role="alert">
                                        Silahkan isi Username dan Password
                                    </div>
                                @endif
                                @if(session('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('failed') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">NIM</span>
                                        </div>
                                        <input type="number" class="form-control" id="login" name="login">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Password</span>
                                        </div>
                                        <input type="password" class="form-control" id="loginpassword" name="loginpassword">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </form>
                        </div>
                    <div class="card text-white bg-primary d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <h2>Sign up</h2><br>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <button class="btn btn-lg btn-outline-light mt-3" data-toggle="modal" data-target="#register" type="button">Register Now!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_daftar"  action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nim</label>
                            <input type="number" class="form-control" id="nim" name="nim" placeholder="NIM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aksi="input" id="submit_pengguna">Daftar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/jquery-1.10.2.js')}}"></script>
    <script type="text/javascript">
        function resetFormdaftar() {
            $("#form_daftar")[0].reset();
            $('#nama').val("").change();
            $('#nim').val("").change();
            $('#password').val("").change();
        }

        $('#submit_pengguna').click(function () {
            var aksi = $("#submit_pengguna").attr("aksi");
            $.ajax({
                url: "{{ url('register') }}",
                type: "post",
                data: new FormData($('#form_daftar')[0] ),
                async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (response) {
                    var pesan = JSON.parse(response);
                    if(pesan.error != null){
                        iziToast.error({
                            title: 'Error notice',
                            position: 'topRight',
                            message: pesan.error,
                        });
                        resetFormdaftar();
                    }else if(pesan.success != null){
                        iziToast.success({
                            title: 'Success notice',
                            position: 'topRight',
                            message: pesan.success
                        });
                        resetFormdaftar();
                        $('#register').modal('toggle');
                    }else {
                        iziToast.warning({
                            title: 'Warning',
                            position: 'topRight',
                            message: "Can't retrieve any data from server",
                        });
                    }
                },
                fail: function () {
                    iziToast.error({
                        title: 'Error notice',
                        message: 'Gagal Menambahkan Data pengguna',
                        transitionOut: 'fadeOutUp'
                    });
                }
            });
        });

        $('#register').on('show.bs.modal',function () {
            resetFormdaftar();
            $("#submit_pengguna").attr("submit_pengguna");
        });
    </script>
</html>
