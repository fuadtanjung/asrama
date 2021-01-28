@extends('layouts.navbar')

@section('content')
    <div  class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Jalur Masuk</div>
            <br>
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_jalur">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft table-bordered table-sm" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Jalur Masuk</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade" id="input_jalur" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Jalur Masuk</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_jalur" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Nama Jalur Masuk
                                    </label>
                                    <input class="form-control form-control-solid" id="nama_jalur" name="nama_jalur" type="text">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-primary" type="button" id="submit_jalur" aksi="input">Submit
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
            $('#datatable').dataTable({
                "ajax": "{{ url('/jalurmasuk/data') }}",
                "columns": [
                    { "data": "nama_jalur" },
                    {
                        render: function() {
                            return '<a href="#" id="edit" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-edit" style="margin-right: 7px"></i> Edit</a> &nbsp' +
                                '<a href="#" id="delete" class="btn btn-outline-danger btn-sm legitRipple"><i class="fa fa-trash" style="margin-right: 7px"></i> Hapus</a>'
                        }
                    }
                ],
            });
        }

        function resetFormJalur() {
            $("#form_jalur")[0].reset();
        }

        $(window).on('load', function () {
            loadData();
            $('#submit_jalur').click(function () {
                var aksi = $("#submit_jalur").attr("aksi");
                if(aksi=="input"){
                    $.ajax({
                        url: "{{ url('/jalurmasuk/input') }}",
                        type: "post",
                        data: new FormData($('#form_jalur')[0]),
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
                                resetFormJalur();
                                $('#input_jalur').modal('toggle');
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
                    var id_jalur= $("#submit_jalur").attr("idjalur");
                    $.ajax({
                        url: "{{ url('/jalurmasuk/edit') }}/"+id_jalur,
                        type: "post",
                        data: new FormData($('#form_jalur')[0]),
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
                                resetFormJalur();
                                $('#input_jalur').modal('toggle');
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
                                $('#submit_jalur').attr("data-aksi","input");
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
                $('#nama_jalur').val(data.nama_jalur);
                $("#submit_jalur").attr("aksi","edit");
                $('#submit_jalur').attr("idjalur",data.id);
                $('#input_jalur').modal('toggle');
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
                                url: "{{ url('/jalurmasuk/delete/') }}/" + data.id,
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

            $('#input_jalur').on('hidden.bs.modal', function () {
                resetFormJalur();
                $("#submit_jalur").attr("aksi","input");
                $('#submit_jalur').removeAttr("idjalur");
            });
        })
    </script>
@endsection

