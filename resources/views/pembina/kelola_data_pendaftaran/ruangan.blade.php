@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Ruangan Asrama Gedung {{  $idgedung->nama_gedung }}</div>
            <br>
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_ruangan">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft table-sm table-bordered" id="datatable">
                    <thead class="text-center">
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Status Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade" id="input_ruangan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Ruangan</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_ruangan" method="post">
                                @csrf
                                <input class="form-control form-control-solid" name="id_gedung" type="text" value="{{ $idgedung->id }}" hidden>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Nama Ruangan
                                    </label>
                                    <input class="form-control form-control-solid" id="nama_ruangan" name="nama_ruangan" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Status Ruangan
                                    </label>
                                    <select class="form-control" id="status_ruangan"
                                            name="status_ruangan">
                                        <option value="">Pilih Status Ruangan</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Tidak Baik">Tidak Baik</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-primary" type="button" id="submit_ruangan" aksi="input">Submit
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
                    "url" : "{{ url('ruangan/data/') }}/" + id,
                    "type" : "GET",
                    "datatype" : 'json'
                },
                "columns": [
                    { "data": "nama_ruangan" },
                    { "data": "status_ruangan" },
                    {
                        render: function() {
                            return '<a href="#" id="edit" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-edit" style="margin-right: 7px"></i> Edit</a> &nbsp' +
                                '<a href="#" id="delete" class="btn btn-outline-danger btn-sm legitRipple"><i class="fa fa-trash" style="margin-right: 7px"></i> Hapus</a>'
                        }
                    }
                ],
            });
        }

        function resetFormRuangan() {
            $("#form_ruangan")[0].reset();
        }

        $(window).on('load', function () {
            loadData();
            $('#submit_ruangan').click(function () {
                var aksi = $("#submit_ruangan").attr("aksi");
                if(aksi=="input"){
                    $.ajax({
                        url: "{{ url('/ruangan/input') }}",
                        type: "post",
                        data: new FormData($('#form_ruangan')[0]),
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
                                resetFormRuangan();
                                $('#input_ruangan').modal('toggle');
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
                    var id_ruangan= $("#submit_ruangan").attr("idruangan");
                    $.ajax({
                        url: "{{ url('/ruangan/edit') }}/"+id_ruangan,
                        type: "post",
                        data: new FormData($('#form_ruangan')[0]),
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
                                resetFormRuangan();
                                $('#input_ruangan').modal('toggle');
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
                                $('#submit_ruangan').attr("data-aksi","input");
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
                $('#nama_ruangan').val(data.nama_ruangan);
                $('#status_ruangan').val(data.status_ruangan);
                $('#gedung').val(data.gedung_id);
                $("#submit_ruangan").attr("aksi","edit");
                $('#submit_ruangan').attr("idruangan",data.id);
                $('#input_ruangan').modal('toggle');
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
                                url: "{{ url('/ruangan/delete/') }}/" + data.id,
                                type: "post",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                cache: false,
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
                                        table.destroy();
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
                                        table.destroy();
                                        loadData();
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

            $('#input_ruangan').on('hidden.bs.modal', function () {
                resetFormRuangan();
                $("#submit_ruangan").attr("aksi","input");
                $('#submit_ruangan').removeAttr("idruangan");
            });
        })
    </script>
@endsection
