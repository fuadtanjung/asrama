@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">

            <div class="card-header">Tugas Bulanan {{ $namamahasiswa->nama }}</div>
            <br>
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_tugasbulananmhs">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tugas</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade" id="input_tugasbulananmhs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tugas Bulanan</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_tugasbulananmhs" method="post">
                                @csrf
                                <input type="text" class="form-control" id="mahasiswa" name="mahasiswa" value="{{ $namamahasiswa->user_id}}" hidden>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Nama Tugas
                                    </label>
                                    <select class="custom-select select2" id="tugas" name="tugas">
                                        <option value="">Pilih Tugas</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Bulan
                                    </label>
                                    <select class="custom-select select2" id="bulan" name="bulan">
                                        <option value="">Pilih Bulan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Tahun
                                    </label>
                                    <select class="custom-select select2" id="tahun" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Keterangan
                                    </label>
                                    <textarea  class="form-control" name="keterangan" id="keterangan" ></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-primary" type="button" id="submit_tugasbulananmhs" aksi="input">Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function loadData() {
            var id =  "{{ $id }}";
            $('#datatable').dataTable({
                "ajax" : {
                    "url" : "{{ url('/tugasbulananmahasiswa/data/') }}/" + id,
                    "type" : "GET",
                    "datatype" : 'json'
                },
                "columns": [
                    {"data" : "no"},
                    { "data": "nama_tugas" },
                    { "data": "tahun" },
                    { "data": "bulan" },
                    { "data": "keterangan" },
                    {
                        render: function() {
                            return '<a href="#" id="edit" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-edit"></i> Edit</a> &nbsp' +
                                '<a href="#" id="delete" class="btn btn-outline-danger btn-sm legitRipple"><i class="fa fa-trash"></i> Hapus</a>'
                        }
                    }
                ],
            });
        }
        function resetFormTugasbulananmhs() {
            $("#form_tugasbulananmhs")[0].reset();
        }
        $(window).on('load', function () {
            loadData();
            $('#submit_tugasbulananmhs').click(function () {
                var aksi = $("#submit_tugasbulananmhs").attr("aksi");
                if(aksi=="input"){
                    $.ajax({
                        url: "{{ url('tugasbulananmahasiswa/input') }}",
                        type: "post",
                        data: new FormData($('#form_tugasbulananmhs')[0]),
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
                                    timeout :'2500',
                                    transitionIn: 'flipInX',
                                    transitionOut: 'flipOutX'
                                });
                                $('#datatable').DataTable().destroy();
                                loadData();
                            }else if(pesan.success != null){
                                iziToast.success({
                                    title: 'Success notice',
                                    position: 'topRight',
                                    message: pesan.success,
                                    timeout :'2500',
                                    transitionIn: 'flipInX',
                                    transitionOut: 'flipOutX'
                                });
                                resetFormTugasbulananmhs();
                                $('#input_tugasbulananmhs').modal('toggle');
                                $('#datatable').DataTable().destroy();
                                loadData();
                            }else {
                                iziToast.warning({
                                    title: 'Warning',
                                    position: 'topRight',
                                    message: "Can't retrieve any data from server",
                                    timeout :'2500',
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
                                timeout :'2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                        }
                    });
                }else if(aksi=="edit"){
                    var id_tugasbulananmhs= $("#submit_tugasbulananmhs").attr("idtugasbulananmhs");
                    $.ajax({
                        url: "{{ url('tugasbulananmahasiswa/edit/') }}/"+id_tugasbulananmhs,
                        type: "post",
                        data: new FormData($('#form_tugasbulananmhs')[0]),
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
                                    timeout :'2500',
                                    transitionIn: 'flipInX',
                                    transitionOut: 'flipOutX'
                                });
                                $('#datatable').DataTable().destroy();
                                loadData();
                            }else if(pesan.success != null){
                                iziToast.success({
                                    title: 'Success notice',
                                    position: 'topRight',
                                    message: pesan.success,
                                    timeout :'2500',
                                    transitionIn: 'flipInX',
                                    transitionOut: 'flipOutX'
                                });
                                resetFormTugasbulananmhs();
                                $('#input_tugasbulananmhs').modal('toggle');
                                $('#datatable').DataTable().destroy();
                                loadData();
                            }else {
                                iziToast.warning({
                                    title: 'Warning',
                                    position: 'topRight',
                                    message: "Can't retrieve any data from server",
                                    timeout :'2500',
                                    transitionIn: 'flipInX',
                                    transitionOut: 'flipOutX'
                                });
                                $('#submit_tugasbulananmhs').attr("data-aksi","input");
                            }
                        },
                        fail: function () {
                            iziToast.error({
                                title: 'Error notice',
                                message: 'Gagal Menambahkan Data pengguna',
                                transitionOut: 'fadeOutUp',
                                timeout :'2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                        }
                    });
                }
            });
            $('#datatable tbody').on('click', '#edit', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                $('#nama_tugas').val(data.id);
                $('#bulan').val(data.bulan);
                $('#tahun').val(data.tahun);
                $('#keterangan').val(data.keterangan);
                $("#submit_tugasbulananmhs").attr("aksi","edit");
                $('#submit_tugasbulananmhs').attr("idtugasbulananmhs",data.tugas_bulanan_id);
                $('#input_tugasbulananmhs').modal('toggle');
            } );
            $('#datatable tbody').on('click', '#delete', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                iziToast.question({
                    timeout: 5000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Konfirmasi',
                    message: 'Anda Yakin Menghapus Data Ini?',
                    position: 'center',
                    buttons: [
                        ['<button><b>Iya!</b></button>', function (instance, toast) {
                            $.ajax({
                                url: "{{ url('tugasbulananmahasiswa/delete/')}}/" + data.tugas_bulanan_id + '/' + data.bulan + '/' + data.tahun + '/' + data.mahasiswa_id,
                                type: "post",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                cache: false,
                                success: function (response) {
                                    console.log(response);
                                    var pesan = JSON.parse(response);
                                    iziToast.success({
                                        title: 'Success notice',
                                        position: 'topRight',
                                        message: pesan.success,
                                        timeout :'2500',
                                        transitionIn: 'flipInX',
                                        transitionOut: 'flipOutX'
                                    });
                                    table.destroy();
                                    loadData();
                                },
                            });
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }, true],
                        ['<button>Tidak</button>', function (instance, toast) {
                            iziToast.info({
                                title: 'Info notice',
                                position: 'topRight',
                                message: 'Data Tidak Di Hapus',
                                timeout :'2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }],
                    ],
                    onClosing: function(instance, toast, closedBy){
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function(instance, toast, closedBy){
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                });
            });
            $.ajax({
                url: '{{ url('tugasbulanan/listtugasbulanan') }}',
                dataType: "json",
                success: function(data) {
                    var tugas = jQuery.parseJSON(JSON.stringify(data));
                    $.each(tugas, function(k, v) {
                        $('#tugas').append($('<option>', {value: v.tugas_id}).text(v.tugas.nama_tugas))
                        $('#bulan').append($('<option>', {value: v.bulan}).text(v.bulan))
                        $('#tahun').append($('<option>', {value: v.tahun}).text(v.tahun))
                    })
                }
            });

            $('#input_tugasbulananmhs').on('hidden.bs.modal', function () {
                resetFormTugasbulananmhs();
                $("#submit_tugasbulananmhs").attr("aksi","input");
                $('#submit_tugasbulananmhs').removeAttr("idtugasbulanan");
            });
        })
    </script>
@endsection
