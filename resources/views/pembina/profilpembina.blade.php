@extends('layouts.navbar')

@section('content')
    <div class="container mt-4">
        <div class="card" style="width: 70%">
            <div class="card-header">Profile Akun</div>
            <div>
            @if ( auth()->user()->role->nama == "pembina" && $pembina->isEmpty())
            <div class="card-body">
                <div class="container-sm">
                    <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_pembina">
                        <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Isi Profile
                    </button>
                </div>
            </div>
            @elseif ( auth()->user()->role->nama == "pembina" && $pembina->isNotEmpty())
            <div class="card-body" style="margin-right: 10%">
                <form id="form_pembina" method="post">
                    @csrf
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" id="nim"
                               name="nim" value="{{ auth()->user()->pembina->nim}}">

                        <label>Nama</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" id="nama"
                               name="nama" value="{{ auth()->user()->pembina->nama }}" >

                        <label>Pekerjaan</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" id="pekerjaan"
                               name="pekerjaan" value="{{ auth()->user()->pembina->pekerjaan }}">

                        <label>No. Hp</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" id="kontak"
                               name="kontak" value="{{ auth()->user()->pembina->no_hp }}">

                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control  form-control-solid form-control-sm"
                               id="tempat_lahir" name="tempat_lahir" value="{{ auth()->user()->pembina->tempat_lahir }}">

                        <label> Tanggal Lahir</label>
                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ date('d-m-Y',strtotime( auth()->user()->pembina->tanggal_lahir))}}">

                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->pembina->jenis_kelamin}}">

                        <label>Alamat</label>
                        <textarea class="form-control  form-control-solid form-control-sm" name="alamat"
                                  id="alamat"  >{{ auth()->user()->pembina->alamat_asal}}</textarea>
                    </div>
                </form>
                @endif
            </div>
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
                                                   name="tanggal_lahir" />
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
        </div>
    </div>
@endsection
@section('script')
    <script type="javascript">
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

        $(document).ready(function(){
            setDatePicker()
        })
    </script>
@endsection
