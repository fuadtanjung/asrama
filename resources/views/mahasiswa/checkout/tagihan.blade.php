@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 80%">
            <div class="card-header">Tagihan</div>
            <div class="card-body" style="margin-right: 5%">
                <table class="table table-hover table-sm table-bordered table-green-soft table-bordered" id="datatable">
                    <thead class="text-center">
                    <tr>
                        <th>Bulan</th>
                        <th>Keterangan</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="input_bukti" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Bukti Pembayaran</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_bukti" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" id="bulan" name="bln" hidden>
                                <input type="text" id="mhs" name="mhs2" hidden>
                                <div>
                                    <input type="file" name="file" id="chooseFile">
                                </div>

                                <button type="button" aksi="input" id="submit_bukti" class="btn btn-primary btn-lg mt-3">
                                    <b>Upload Files</b>
                                </button>
                            </form>
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
                "ajax": "{{ url('/kartu_checkout/data') }}",
                "columns": [
                    { "data": "bulan" },
                    { "data": "keterangan" },
                    {
                        render: function() {
                            return '<button id="upload" type="button" class="btn btn-outline-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_bukti"> <i class="fa fa-upload" style="margin-right: 7px"></i>Upload </button>'
                        },
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
                        width: "60px",
                        targets: [2]
                    },
                ],
            });
        }

        $(window).on('load', function () {
            loadData();
            $('#submit_bukti').click(function () {
                var bulan= $("#submit_bukti").attr("bulan");
                var id= $("#submit_bukti").attr("idmahasiswa");
                $.ajax({
                    url: "{{ url('/kartu_checkout/uploadbukti') }}/"+ bulan + '/' + id,
                    type: "post",
                    data: new FormData($('#form_bukti')[0]),
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
                            $('#datatable').DataTable().destroy();
                            loadData();
                        } else if (pesan.success != null) {
                            iziToast.success({
                                title: 'Success notice',
                                position: 'topRight',
                                message: pesan.success,
                                timeout: '2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                            $('#input_bukti').modal('toggle');
                            $('#datatable').DataTable().destroy();
                            loadData();
                        } else {
                            iziToast.warning({
                                title: 'Warning',
                                position: 'topRight',
                                message: "Can't retrieve any data from server",
                            });
                        }
                    },
                });
            });

            $('#datatable tbody').on('click', '#upload', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row($(this).parents('tr')).data();
                $('#bulan').val(data.bulan);
                $('#mhs').val(data.mahasiswa_id);
                $('#submit_bukti').attr("bulan",data.bulan).attr("idmahasiswa",data.mahasiswa_id);
                $('#input_bukti').modal('toggle');
            });

            $('#input_bukti').on('hidden.bs.modal', function () {
                $("#submit_bukti").attr("aksi","input");
                $('#submit_bukti').removeAttr("idmahasiswa").removeAttr("bulan");
            });
        })
    </script>
@endsection
