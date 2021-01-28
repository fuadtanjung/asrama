@extends('layouts.navbar')
@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <div class="page-header-icon text-primaryr"><b> Hari dan Tanggal: </b></div>
                    <h1 class="page-header-title">
                      @php setlocale(LC_TIME, 'id_ID.utf8');
                            \Carbon\Carbon::setLocale('id');
                        echo \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y');
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
    @if ( auth()->user()->role->nama == "mahasiswa" && $asrama->isEmpty())
        <div class="card">
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-toggle="tab" role="tab"
                        aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Biodata Mahasiswa</div>
                            <div class="wizard-step-text-details">Informasi Mahasiswa</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab"
                        aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Biodata Keluarga Mahasiswa</div>
                            <div class="wizard-step-text-details">Informasi Keluarga Mahasiswa</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-toggle="tab" role="tab"
                        aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Riwayat Organisasi</div>
                            <div class="wizard-step-text-details">Informasi Riwayat Organisasi</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-toggle="tab" role="tab"
                        aria-controls="wizard4" aria-selected="true">
                        <div class="wizard-step-icon">4</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Riwayat Penyakit</div>
                            <div class="wizard-step-text-details">Informasi Riwayat Penyakit</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form id="form_mahasiswa" method="post">
                    @csrf
                    <div class="tab-content" id="cardTabContent">
                        <!-- Wizard tab pane item 1-->
                        <div class="tab-pane fade show active" id="wizard1" role="tabpanel"
                            aria-labelledby="wizard1-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-6 col-xl-8">
                                    <h3 class="text-primary">Langkah 1</h3>
                                    <form>
                                        <p class="text-sm text-red font-italic">Klik Nomor Panel Ingin Mengisi Data.</p>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nim">Nim</label>
                                                <input class="form-control" id="nim" name="nim" value="{{ Auth::user()->nim }}" type="text" readonly/>
                                                <input type="text" class="form-control form-control-sm" id="id" name="id" value="{{Auth::user()->id}}" hidden>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nama">Nama</label>
                                                <input class="form-control" id="nama" name="nama" value="{{ Auth::user()->name }}" type="text" readonly />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="text" class="form-control datepicker datetimepicker-input" data-toggle="datetimepicker"
                                                    data-target=".datepicker" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="kontak">No. Hp</label>
                                                <input type="text" class="form-control" id="kontak"
                                                       name="kontak" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control " id="jenis_kelamin"
                                                        name="jenis_kelamin" autocomplete="off">
                                                    <option value="laki-laki">Laki - Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat" id="alamat" autocomplete="off"></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Status Rumah</label>
                                                <select class="form-control" id="status_rumah"
                                                        name="status_rumah" autocomplete="off">
                                                    <option value="">Pilih Status Rumah</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Jalur Masuk</label>
                                                <select class="form-control" id="jalur_masuk"
                                                        name="jalur_masuk" autocomplete="off">
                                                    <option value="">Pilih Jalur Masuk</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jurusan</label>
                                                <select class="form-control" id="jurusan"
                                                        name="jurusan" autocomplete="off">
                                                    <option value="">Pilih Jurusan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Bidik Misi</label>
                                                <select class="form-control" id="bidik_misi"
                                                        name="bidik_misi" autocomplete="off">
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Golongan Darah</label>
                                                <select class="form-control" id="goldar"
                                                        name="goldar" autocomplete="off">
                                                    <option value="">Pilih Golongan Darah</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Asal Sekolah</label>
                                                <input type="text" class="form-control"
                                                       id="asal_sekolah" name="asal_sekolah" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Agama</label>
                                                <select class="form-control" id="agama"
                                                        name="agama" autocomplete="off">
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen">Kristen</option>
                                                    <option value="khatolik">Khatolik</option>
                                                    <option value="budha">Budha</option>
                                                    <option value="hindu">Hindu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Shalat Wajib</label>
                                                <select class="form-control" id="shalat_wajib"
                                                        name="shalat_wajib" autocomplete="off">
                                                    <option value="Tidak"> Tidak </option>
                                                    <option value="selalu">Selalu</option>
                                                    <option value="bolong-bolong">Bolong - bolong</option>
                                                    <option value="jarang">Jarang</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Hafalan Quran</label>
                                                <select class="form-control" id="hafalan"
                                                        name="hafalan" autocomplete="off">
                                                    <option value="Tidak Ada"> Tidak Ada </option>
                                                    <option value="<1 juz"> <1 Juz </option>
                                                    <option value="1 - 3 juz"> 1 - 3 Juz</option>
                                                    <option value=">3 Juz"> >3 Juz </option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Wizard tab pane item 2-->
                        <div class="tab-pane fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-6 col-xl-8">
                                    <h3 class="text-primary"> Langkah 2 </h3>
                                        <p class="text-sm text-red font-italic">Klik Nomor Panel Ingin Mengisi Data.</p>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Nama Ayah</label>
                                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nama Ibu</label>
                                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Pekerjaan Ayah</label>
                                                <input type="text" class="form-control"
                                                       id="pekerjaan_ayah" name="pekerjaan_ayah" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Pekerjaan Ibu</label>
                                                <input type="text" class="form-control"
                                                       id="pekerjaan_ibu" name="pekerjaan_ibu" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Pendapatan Ayah</label>
                                                <select class="form-control" id="pendapatan_ayah"
                                                        name="pendapatan_ayah" autocomplete="off">
                                                    <option value="Tidak Ada"> Tidak Ada </option>
                                                    <option value="<1 juta">
                                                        <1 Juta </option> <option value="1 - 3 juta"> 1 - 2 Juta
                                                    </option>
                                                    <option value="2 - 3 juta"> 2 - 3 Juta</option>
                                                    <option value=">3 Juta"> >3 Juta </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Pendapatan Ibu</label>
                                                <select class="form-control" id="pendapatan_ibu"
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
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>No. Hp Orang Tua</label>
                                                <input type="text" class="form-control"
                                                       id="kontak_orang_tua" name="kontak_orang_tua" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Anak Ke</label>
                                                <input type="text" class="form-control" id="anak_ke"
                                                       name="anak_ke" autocomplete="off" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Jumlah Saudara</label>
                                                <input type="text" class="form-control"
                                                       id="jumlah_saudara" name="jumlah_saudara" autocomplete="off"/>
                                            </div>

                                        </div>
                                        <hr class="my-4" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Wizard tab pane item 3-->
                        <div class="tab-pane fade" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                            <div class="justify-content-left">
                                <div>
                                    <h3 class="text-primary">Langkah 3</h3>
                                    <h5 class="card-title">Jika Tidak Ada Riwayat Organisasi Boleh Kosong</h5>
                                        <p class="text-sm text-red font-italic">Klik Nomor Panel Ingin Mengisi Data.</p>
                                    <div class="field_wrappers">
                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label for="exampleFormControlInput1">Nama Organisasi</label>
                                                <input class="form-control" id="nama_organisasi" name="nama_organisasi[]" type="text">
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="exampleFormControlInput1">
                                                    Jabatan
                                                </label>
                                                <input class="form-control" id="jabatan" name="jabatan[]" type="text">
                                            </div>
                                            <div class="form-group col-5">
                                                    <label>Durasi</label>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <input type="date" class="form-control" id="mulai" name="mulai[]"/>
                                                        <small class="text-red font-italic" style="margin-left: 5%">Mulai</small>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <input type="date" class="form-control" id="akhir" name="akhir[]" />
                                                        <small class="text-red font-italic" style="margin-left: 5%">Akhir</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-1">
                                                <button class="btn btn-success add-more" id="add_buttons" style="margin-top: 50%" type="button"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                        <hr class="my-2" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Wizard tab pane item 4-->
                        <div class="tab-pane fade" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                            <div class="justify-content-center">
                                <div class="col-xxl-6 col-xl-8">
                                    <h3 class="text-primary">Step 4</h3>
                                    <h5 class="card-title">Jika Tidak Ada Riwayat Penyakit Boleh Kosong</h5>
                                        <p class="text-sm text-red font-italic">Klik Nomor Panel Ingin Mengisi Data.</p>
                                    <div class="field_wrapper">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="form-group col-10">
                                                    <label>Nama Penyakit</label>
                                                  <input class="form-control" id="nama_penyakit" name="nama_penyakit[]" type="text">
                                                </div>
                                                <div class="form-group col-2">
                                                    <button class="btn btn-success" style="margin-top: 37%;"  id="add_button" type="button"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <hr class="my-4" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <div class="float-right">
                            <button class="btn btn-primary" type="button" id="submit_mahasiswa" aksi="input">Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ( auth()->user()->role->nama == "mahasiswa" && $asrama->isNotEmpty())
    <div class="card card-waves mb-4 mt-5">
        <div class="card-body p-5">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h2 class="text-primary">Selamat Datang Di Aplikasi Asrama.</h2>
                    <p class="text-gray-700">Aplikasi ini digunakan agar memudahkan segala urusan antara
                        Mahasiswa Asrama dan Pembina Asrama. </p>
                    @if(auth()->user()->role->nama == "mahasiswa" and auth()->user()->mahasiswa->status == 'tidak aktif' )
                    <h2 class="text-danger"> Download Surat Bebas Asrama di Menu Kamar Asrama</h2>
                    @endif
                    {{-- <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal"
                        data-target="#input_mahasiswa">
                        Isi Pendaftaran Dulu! <i class="fa fa-arrow-right" style="margin-left: 7px"></i>
                    </button> --}}


                    {{-- @if ( auth()->user()->role->nama == "pembina" && $pembina->isEmpty())
                        <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_pembina">
                            <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Isi Profile
                        </button>
                    @endif --}}
                </div>
                <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5"
                        src="{{ url('images/at-work-pana.svg')}}" /></div>
            </div>
        </div>
    </div>
    @endif

    @if ( auth()->user()->role->nama == "pembina")
    <div class="card card-waves mb-4 mt-5">
        <div class="card-body p-5">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h2 class="text-primary">Selamat Datang Di Aplikasi Asrama.</h2>
                    <p class="text-gray-700">Aplikasi ini digunakan agar memudahkan segala urusan antara
                        Mahasiswa Asrama dan Pembina Asrama. </p>


                    {{-- <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal"
                        data-target="#input_mahasiswa">
                        Isi Pendaftaran Dulu! <i class="fa fa-arrow-right" style="margin-left: 7px"></i>
                    </button> --}}


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
    @endif
</div>

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

    $(document).ready(function() {
        var maxField = 10;
        var addButton = $('#add_buttons');
        var wrapper = $('.field_wrappers');
        var fieldHTML = '<div class="form-row add">';
        fieldHTML = fieldHTML + ' <div class="form-group col-3"> <label for="exampleFormControlInput1">Nama Organisasi</label> <input class="form-control" id="nama_organisasi" name="nama_organisasi[]" type="text"> </div>';
        fieldHTML = fieldHTML + ' <div class="form-group col-3"> <label for="exampleFormControlInput1">Jabatan </label> <input class="form-control" id="jabatan" name="jabatan[]" type="text"> </div>';
        fieldHTML = fieldHTML + ' <div class="form-group col-5"> <label>Durasi</label> <div class="form-row"> <div class="form-group col-6"> <input type="date" class="form-control" id="mulai" name="mulai[]"/> <small class="text-red font-italic" style="margin-left: 5%">Mulai</small> </div> <div class="form-group col-6"> <input type="date" class="form-control" id="akhir" name="akhir[]" /> <small class="text-red font-italic" style="margin-left: 5%">Akhir</small> </div> </div> </div>';
        fieldHTML = fieldHTML + '<div class="form-group col-1"> <button class="remove_buttons btn btn-danger" style="margin-top: 50%" type="button"><i class="fa fa-trash"></i></button> </div>';
        fieldHTML = fieldHTML + '</div>';
        var x = 1;

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_buttons', function(e){
            e.preventDefault();
            $(this).parent('').parent('').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function() {
       var maxField = 10;
       var addButton = $('#add_button');
       var wrapper = $('.field_wrapper');
       var fieldHTML = '<div class="form-group add">';
       fieldHTML = fieldHTML + ' <div class="form-row">';
       fieldHTML = fieldHTML + ' <div class="form-group col-10"> <label>Nama Penyakit</label> <input class="form-control" id="nama_penyakit" name="nama_penyakit[]" type="text"> </div>';
       fieldHTML = fieldHTML + '<div class="form-group col-2"> <button class="remove_button btn btn-danger" style="margin-top: 37%;" type="button"><i class="fa fa-trash"></i></button> </div>';
       fieldHTML = fieldHTML + '</div></div>';
       var x = 1;

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('').parent('').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function() {
        $('#jurusan').select2();
    });
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
