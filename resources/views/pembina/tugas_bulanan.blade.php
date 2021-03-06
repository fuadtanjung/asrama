@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 95%">
            <div class="card-header">Tugas Bulanan</div>
            <br>
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_tugas_bulanan">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Tugas</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade" id="input_tugas_bulanan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tugas Bulanan</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_tugas_bulanan" method="post">
                                @csrf
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
                                        Tahun
                                    </label>
                                    <input type="text" class="form-control yearpicker datetimepicker-input" data-toggle="datetimepicker" data-target=".yearpicker" name="tahun" id="tahun" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Bulan
                                    </label>
                                    <input type="text" class="form-control monthpicker datetimepicker-input" data-toggle="datetimepicker" data-target=".monthpicker" name="bulan" id="bulan"/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-primary" type="button" id="submit_tugas_bulanan" aksi="input">Submit
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
                "ajax": "{{ url('/tugasbulanan/data') }}",
                "columns": [
                    { "data": "nama_tugas" },
                    { "data": "tahun" },
                    { "data": "bulan" },
                    {
                        render: function() {
                            return '<a href="#" id="edit" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-edit"></i> Edit</a> &nbsp' +
                                '<a href="#" id="delete" class="btn btn-outline-danger btn-sm legitRipple"><i class="fa fa-trash"></i> Hapus</a>'
                        }
                    }
                ],
                columnDefs: [
                    {
                        width: "20px",
                        targets: [0]
                    },
                    {
                        width: "20px",
                        targets: [1]
                    },
                    {
                        width: "20px",
                        targets: [2]
                    },
                    {
                        width: "20px",
                        targets: [3]
                    },
                ],
            });
        }

        function resetFormTugasBulanan() {
            $("#form_tugas_bulanan")[0].reset();
        }

        $(window).on('load', function () {
            loadData();
            $('#submit_tugas_bulanan').click(function () {
                var aksi = $("#submit_tugas_bulanan").attr("aksi");
                if(aksi=="input"){
                    $.ajax({
                        url: "{{ url('/tugasbulanan/input') }}",
                        type: "post",
                        data: new FormData($('#form_tugas_bulanan')[0]),
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
                                resetFormTugasBulanan();
                                $('#input_tugas_bulanan').modal('toggle');
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
                    var id_tugas_bulanan= $("#submit_tugas_bulanan").attr("idtugasbulanan");
                    $.ajax({
                        url: "{{ url('/tugasbulanan/edit') }}/" + id_tugas_bulanan,
                        type: "post",
                        data: new FormData($('#form_tugas_bulanan')[0]),
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
                                resetFormTugasBulanan();
                                $('#input_tugas_bulanan').modal('toggle');
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
                                $('#submit_tugas_bulanan').attr("data-aksi","input");
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
                $('#tugas').val(data.tugas_id);
                $('#tahun').val(data.tahun);
                $('#bulan').val(data.bulan);
                $("#submit_tugas_bulanan").attr("aksi","edit");
                $('#submit_tugas_bulanan').attr("idtugasbulanan",data.bulan);
                $('#input_tugas_bulanan').modal('toggle');
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
                                url: "{{ url('/tugasbulanan/delete/') }}/" + data.tugas_id + '/' + data.bulan + '/' + data.tahun,
                                type: "post",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                cache: false,
                                success: function (response) {
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
                url: '{{ url('tugasbulanan/listtugas') }}',
                dataType: "json",
                success: function(data) {
                    var tugas = jQuery.parseJSON(JSON.stringify(data));
                    $.each(tugas, function(k, v) {
                        $('#tugas').append($('<option>', {value: v.id}).text(v.nama_tugas))
                    })
                }
            });

            $('#input_tugas_bulanan').on('hidden.bs.modal', function () {
                resetFormTugasBulanan();
                $("#submit_tugas_bulanan").attr("aksi","input");
                $('#submit_tugas_bulanan').removeAttr("idtugasbulanan");
            });
        })

        $(document).ready(function(){
            setMonthPicker()
            setYearPicker()
        })
    </script>
@endsection
