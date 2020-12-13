@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card">
            <div class="card-header">Pengalaman Organisasi</div>
            <br>
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_pengalaman">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Organisasi</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade" id="input_pengalaman" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Pengalaman Organasasi</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_pengalaman" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Nama Organisasi
                                    </label>
                                    <input class="form-control form-control-solid" id="nama_organisasi" name="nama_organisasi" type="text" placeholder="Nama Organisasi">
                                    <input class="form-control form-control-solid" id="id" name="id" type="text" value="{{ auth()->user()->id}}" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                      Durasi
                                    </label>
                                    <input type="text" class="form-control startdate datetimepicker-input form-control-solid"
                                           data-toggle="datetimepicker" data-target=".startdate" placeholder="Mulai" id="mulai" name="mulai"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">s/d</span>
                                    </div>
                                    <input type="text" class="form-control enddate datetimepicker-input form-control-solid"
                                           data-toggle="datetimepicker" data-target=".enddate" placeholder="Akhir" id="akhir" name="akhir" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Jabatan
                                    </label>
                                    <input class="form-control form-control-solid" id="jabatan" name="jabatan" type="text" placeholder="Jabatan">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-primary" type="button" id="submit_pengalaman" aksi="input">Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <input type="text" value="{{ date('d-m-Y',strtotime(auth()->user()->mahasiswa->pengalaman_organisasi->mulai))}}">--}}
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            setDateRangePicker(".startdate", ".enddate")
        })

        function loadData() {
            $('#datatable').dataTable({
                "ajax": "{{ url('/pengalamanorganisasi/data') }}",
                "columns": [
                    { "data": "nama_organisasi" },
                    { "data": "mulai" },
                    { "data": "akhir" },
                    { "data": "jabatan" },
                    {
                        render: function() {
                            return '<a href="#" id="edit" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-edit"></i> Edit</a> &nbsp' +
                                '<a href="#" id="delete" class="btn btn-outline-danger btn-sm legitRipple"><i class="fa fa-trash"></i> Hapus</a>'
                        }
                    }
                ],
                columnDefs: [{
                    width: 250,
                    targets: [ 0 ]
                },{
                    width: 150,
                    targets: [ 3 ]
                },{
                    width: 130,
                    targets: [ 4 ]
                }],
            });
        }

        function resetFormPengalaman() {
            $("#form_pengalaman")[0].reset();
        }

        $(window).on('load', function () {
            loadData();
            $('#submit_pengalaman').click(function () {
                var aksi = $("#submit_pengalaman").attr("aksi");
                if(aksi=="input"){
                    $.ajax({
                        url: "{{ url('/pengalamanorganisasi/input') }}",
                        type: "post",
                        data: new FormData($('#form_pengalaman')[0]),
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
                                resetFormPengalaman();
                                $('#input_pengalaman').modal('toggle');
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
                    var id_pengalaman= $("#submit_pengalaman").attr("idpengalaman");
                    $.ajax({
                        url: "{{ url('/pengalamanorganisasi/edit') }}/"+id_pengalaman,
                        type: "post",
                        data: new FormData($('#form_pengalaman')[0]),
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
                                resetFormPengalaman();
                                $('#input_pengalaman').modal('toggle');
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
                                $('#submit_pengalaman').attr("data-aksi","input");
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
                $('#nama_organisasi').val(data.nama_organisasi);
                $('#mulai').val(data.mulai);
                $('#akhir').val(data.akhir);
                $('#jabatan').val(data.jabatan);
                $("#submit_pengalaman").attr("aksi","edit");
                $('#submit_pengalaman').attr("idpengalaman",data.id);
                $('#input_pengalaman').modal('toggle');
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
                                url: "{{ url('pengalamanorganisasi/delete/') }}/" + data.id,
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

            $('#input_pengalaman').on('hidden.bs.modal', function () {
                resetFormPengalaman();
                $("#submit_pengalaman").attr("aksi","input");
                $('#submit_pengalaman').removeAttr("idpengalaman");
            });
        })
    </script>
@endsection
