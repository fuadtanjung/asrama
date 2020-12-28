@extends('layouts.navbar')
@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <div class="page-header-icon text-primaryr"><b> Tanggal dan Waktu : </b></div>
                    <h1 class="page-header-title">
                      @php setlocale(LC_TIME, 'id_ID.utf8');
                            \Carbon\Carbon::setLocale('id');
                        echo \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y');
                        echo date(' H:i a');
                        @endphp
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
                    <h2 class="text-primary">Selamat Datang Di Aplikasi Asrama.</h2>
                    <p class="text-gray-700">Aplikasi ini digunakan agar memudahkan segala urusan antara
                        Mahasiswa Asrama dan Pembina Asrama. </p>

                    @if ( auth()->user()->role->nama == "mahasiswa" && $asrama->isEmpty())
                    <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal"
                        data-target="#input_mahasiswa">
                        Isi Pendaftaran Dulu! <i class="fa fa-arrow-right" style="margin-left: 7px"></i>
                    </button>
                    @endif

                    @if ( auth()->user()->role->nama == "pembina" && $pembina->isEmpty())
                        <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_pembina">
                            <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Isi Profile
                        </button>
                    @endif
                </div>
                <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5"
                        src="{{ url('images/at-work-pana.svg')}}" /></div>
            </div>
        </div>
    </div>
</div>

{{--////////////////////////////////////////Mahasiswa/////////////////////////////////////////////////////////////////////--}}
    <div class="modal fade" id="input_mahasiswa" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Form Pendaftaran Mahasiswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                        </div>
                <div class="modal-body">
                    <form id="form_mahasiswa" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>NIM</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="nim"
                                        name="nim" value="{{Auth::user()->nim}}" readonly>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="id"
                                        name="id" value="{{Auth::user()->id}}" hidden>
                                </div>
                                <div class="col-sm-5">
                                    <label>Nama</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="nama"
                                        name="nama" value="{{Auth::user()->name}}" readonly>
                                </div>
                                <div class="col-sm-3" id="tanggal">
                                    <label>No. Hp</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="kontak"
                                        name="kontak" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control  form-control-solid form-control-sm"
                                        id="tempat_lahir" name="tempat_lahir" autocomplete="off">
                                </div>
                                <div class="col-sm-4">
                                    <label> Tanggal Lahir</label>
                                    <div class="input-group mb-2 input-group-sm">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text "><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="text"
                                            class="form-control datepicker datetimepicker-input form-control-solid"
                                            data-toggle="datetimepicker" data-target=".datepicker" id="tanggal_lahir"
                                            name="tanggal_lahir" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="jenis_kelamin"
                                        name="jenis_kelamin" autocomplete="off">
                                        <option value="laki-laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Jurusan</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="jurusan"
                                        name="jurusan" autocomplete="off">
                                        <option value="">Pilih Jurusan</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Status Rumah</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="status_rumah"
                                        name="status_rumah" autocomplete="off">
                                        <option value="">Pilih Status Rumah</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="tanggal">
                                    <label>Jalur Masuk</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="jalur_masuk"
                                        name="jalur_masuk" autocomplete="off">
                                        <option value="">Pilih Jalur Masuk</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="tanggal">
                                    <label>Golongan Darah</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="goldar"
                                        name="goldar" autocomplete="off">
                                        <option value="">Pilih Golongan Darah</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Alamat</label>
                                    <textarea class="form-control  form-control-solid form-control-sm" name="alamat"
                                        id="alamat" autocomplete="off"></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <label>Bidik Misi</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="bidik_misi"
                                        name="bidik_misi" autocomplete="off">
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <label>Asal Sekolah</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                        id="asal_sekolah" name="asal_sekolah" autocomplete="off"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Agama</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="agama"
                                        name="agama" autocomplete="off">
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="khatolik">Khatolik</option>
                                        <option value="budha">Budha</option>
                                        <option value="hindu">Hindu</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Shalat Wajib</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="shalat_wajib"
                                        name="shalat_wajib" autocomplete="off">
                                        <option value="Tidak"> Tidak </option>
                                        <option value="selalu">Selalu</option>
                                        <option value="bolong-bolong">Bolong - bolong</option>
                                        <option value="jarang">Jarang</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Hafalan Quran</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="hafalan"
                                        name="hafalan" autocomplete="off">
                                        <option value="Tidak Ada"> Tidak Ada </option>
                                        <option value="<1 juz"> <1 Juz </option>
                                        <option value="1 - 3 juz"> 1 - 3 Juz</option>
                                        <option value=">3 Juz"> >3 Juz </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                        id="nama_ayah" name="nama_ayah" autocomplete="off"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="nama_ibu"
                                        name="nama_ibu" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Pekerjaan Ayah</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                        id="pekerjaan_ayah" name="pekerjaan_ayah" autocomplete="off"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>Pekerjaan Ibu</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                        id="pekerjaan_ibu" name="pekerjaan_ibu" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Pendapatan Ayah</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="pendapatan_ayah"
                                        name="pendapatan_ayah" autocomplete="off">
                                        <option value="Tidak Ada"> Tidak Ada </option>
                                        <option value="<1 juta">
                                            <1 Juta </option> <option value="1 - 3 juta"> 1 - 2 Juta
                                        </option>
                                        <option value="2 - 3 juta"> 2 - 3 Juta</option>
                                        <option value=">3 Juta"> >3 Juta </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Pekerjaan Ibu</label>
                                    <select class="form-control  form-control-solid form-control-sm" id="pendapatan_ibu"
                                        name="pendapatan_ibu" autocomplete="off">
                                        <option value="Tidak Ada"> Tidak Ada </option>
                                        <option value="<1 juta">
                                            <1 Juta </option> <option value="1 - 3 juta"> 1 - 2 Juta
                                        </option>
                                        <option value="2 - 3 juta"> 2 - 3 Juta</option>
                                        <option value=">3 Juta"> >3 Juta </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>No. Hp Orang Tua</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                        id="kontak_orang_tua" name="kontak_orang_tua" autocomplete="off"/>
                                </div>
                                <div class="col-sm-4">
                                    <label>Anak Ke</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="anak_ke"
                                        name="anak_ke" autocomplete="off" />
                                </div>
                                <div class="col-sm-4">
                                    <label>Jumlah Saudara</label>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                        id="jumlah_saudara" name="jumlah_saudara" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" id="submit_mahasiswa" aksi="input">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
{{--/////////////////////////////////////////////////////////Mahasiswa////////////////////////////////--}}


{{--///////////////////////////////////////////////Pembina/////////////////////////////////////////////////--}}
    <div class="modal fade" id="input_pembina" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Form Profil Pembina</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="form_pembina" method="post">
                        @csrf
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="nim"
                                   name="nim" value="{{Auth::user()->nim}}" readonly>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="id"
                                   name="id" value="{{Auth::user()->id}}" hidden>
                            <label>Nama</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="nama"
                                   name="nama" value="{{Auth::user()->name}}" readonly>
                            <label>Pekerjaan</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="pekerjaan"
                                   name="pekerjaan">

                            <label>No. Hp</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="kontak"
                                   name="kontak">

                            <label>Pembina Gedung</label>
                            <select class="form-control  form-control-solid form-control-sm" id="gedung"
                                    name="gedung" autocomplete="off">
                                <option value="">Pilih Gedung</option>
                            </select>

                            <label for="exampleFormControlInput1">
                                Pembina Tahun
                            </label>
                            <input type="text" class="form-control form-control-solid form-control-sm yearpicker datetimepicker-input" data-toggle="datetimepicker" data-target=".yearpicker" name="tahun" id="tahun" />

                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control  form-control-solid form-control-sm"
                                   id="tempat_lahir" name="tempat_lahir">

                            <label> Tanggal Lahir</label>
                            <div class="input-group mb-2 input-group-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text "><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text"
                                       class="form-control datepicker datetimepicker-input form-control-solid"
                                       data-toggle="datetimepicker" data-target=".datepicker" id="tanggal_lahir"
                                       name="tanggal_lahir" autocomplete="off">
                            </div>

                            <label>Jenis Kelamin</label>
                            <select class="form-control  form-control-solid form-control-sm" id="jenis_kelamin"
                                    name="jenis_kelamin">
                                <option value="laki-laki">Laki - Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>

                            <label>Alamat</label>
                            <textarea class="form-control  form-control-solid form-control-sm" name="alamat"
                                      id="alamat"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" id="submit_pembina" aksi="input">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
{{--///////////////////////////////////////////////Pembina/////////////////////////////////////////////////--}}

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

        function resetFormMahasiswa() {
            $("#form_mahasiswa")[0].reset();
        }
        $(window).on('load', function () {
            $('#submit_mahasiswa').click(function () {
                $("#submit_mahasiswa").attr("aksi");
                $.ajax({
                    url: "{{ url('/mahasiswa/input') }}",
                    type: "post",
                    data: new FormData($('#form_mahasiswa')[0]),
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                        var pesan = JSON.parse(response);
                        if (pesan.error != null) {
                            iziToast.error({
                                title: 'Error notice',
                                position: 'topRight',
                                message: pesan.error,
                                timeout: '2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                        } else if (pesan.success != null) {
                            iziToast.success({
                                title: 'Success notice',
                                position: 'topRight',
                                message: pesan.success,
                                timeout: '2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                            window.location.href = "{{ url('/')}}"
                        } else {
                            iziToast.warning({
                                title: 'Warning',
                                position: 'topRight',
                                message: "Can't retrieve any data from server",
                                timeout: '2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                        }
                    },
                    fail: function () {
                        iziToast.error({
                            title: 'Error notice',
                            message: 'Gagal Menambahkan Data pengguna',
                            transitionOut: 'fadeOutUp',
                            timeout: '2500',
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX'
                        });
                    }
                });
            });

            $.ajax({
                url: '{{ url('mahasiswa/listjurusan') }}',
                dataType: "json",
                success: function (data) {
                    var jurusan = jQuery.parseJSON(JSON.stringify(data));
                    $.each(jurusan, function (k, v) {
                        $('#jurusan').append($('<option>', {value: v.id}).text(v.nama_jurusan))
                    })
                }
            });

            $.ajax({
                url: '{{ url('mahasiswa/liststatusrumah') }}',
                dataType: "json",
                success: function (data) {
                    var status_rumah = jQuery.parseJSON(JSON.stringify(data));
                    $.each(status_rumah, function (k, v) {
                        $('#status_rumah').append($('<option>', {value: v.id}).text(v.nama_status))
                    })
                }
            });

            $.ajax({
                url: '{{ url('mahasiswa/listjalurmasuk') }}',
                dataType: "json",
                success: function (data) {
                    var jalur_masuk = jQuery.parseJSON(JSON.stringify(data));
                    $.each(jalur_masuk, function (k, v) {
                        $('#jalur_masuk').append($('<option>', {value: v.id}).text(v.nama_jalur))
                    })
                }
            });

            $.ajax({
                url: '{{ url('mahasiswa/listgoldar') }}',
                dataType: "json",
                success: function (data) {
                    var goldar = jQuery.parseJSON(JSON.stringify(data));
                    $.each(goldar, function (k, v) {
                        $('#goldar').append($('<option>', {value: v.id}).text(v.nama_goldar))
                    })
                }
            });

        });

        $(document).ready(function(){
            setDatePicker()
            setYearPicker()
        })



    ////////////////////Pembina//////////////////////////////////////////
    function resetFormPembina() {
        $("#form_pembina")[0].reset();
    }
    $(window).on('load', function () {
        $('#submit_pembina').click(function () {
            $("#submit_pembina").attr("aksi");
            $.ajax({
                url: "{{ url('/pembina/input') }}",
                type: "post",
                data: new FormData($('#form_pembina')[0]),
                async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (response) {
                    var pesan = JSON.parse(response);
                    if (pesan.error != null) {
                        iziToast.error({
                            title: 'Error notice',
                            position: 'topRight',
                            message: pesan.error,
                            timeout: '2500',
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX'
                        });
                    } else if (pesan.success != null) {
                        iziToast.success({
                            title: 'Success notice',
                            position: 'topRight',
                            message: pesan.success,
                            timeout: '2500',
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX'
                        });
                        window.location.href = "{{ url('/pembina')}}"
                    } else {
                        iziToast.warning({
                            title: 'Warning',
                            position: 'topRight',
                            message: "Can't retrieve any data from server",
                            timeout: '2500',
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX'
                        });
                    }
                },
                fail: function () {
                    iziToast.error({
                        title: 'Error notice',
                        message: 'Gagal Menambahkan Data pengguna',
                        transitionOut: 'fadeOutUp',
                        timeout: '2500',
                        transitionIn: 'flipInX',
                        transitionOut: 'flipOutX'
                    });
                }
            });
        });
    });

    $.ajax({
        url: '{{ url('gedung/listgedung') }}',
        dataType: "json",
        success: function (data) {
            var goldar = jQuery.parseJSON(JSON.stringify(data));
            $.each(goldar, function (k, v) {
                $('#gedung').append($('<option>', {value: v.id}).text(v.nama_gedung))
            })
        }
    });
</script>
@endsection
