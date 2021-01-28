@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Checkout Mahasiswa</h1>
            </div>
            <!-- Date range picker example button-->
        </div>
    </div>
    <div class="container mt-1">

        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-sm" id="datatable">
                    <thead style="text-align: center">
                    <tr>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center" >
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@section('script')

    <script>
        function loadData() {
            $('#datatable').dataTable({
                "ajax": "{{ url('/checkoutmahasiswa/data') }}",
                "columns": [
                    {"data": "nama"},
                    {
                        render: function () {
                            return '<a href="#" id="change" class="btn btn-outline-success btn-sm legitRipple"><i class="fa fa-share" style="margin-right: 5px"></i> CheckOut Mahasiswa</a>'
                        }
                    }
                ],
            });
        }

        $(window).on('load', function () {
            loadData();
            $('#datatable tbody').on('click', '#change', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row($(this).parents('tr')).data();
                iziToast.question({
                    timeout: 5000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Konfirmasi',
                    message: 'Anda Yakin Check Out Mahasiswa Ini?',
                    position: 'center',
                    buttons: [
                        ['<button><b>Iya!</b></button>', function (instance, toast) {
                            $.ajax({
                                url: "{{ url('/checkoutmahasiswa/change/') }}/" + data.user_id,
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
                                        timeout: '2500',
                                        transitionIn: 'flipInX',
                                        transitionOut: 'flipOutX'
                                    });
                                    table.destroy();
                                    loadData();
                                },
                            });
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }, true],
                        ['<button>Tidak</button>', function (instance, toast) {
                            iziToast.info({
                                title: 'Info notice',
                                position: 'topRight',
                                message: 'Data Tidak Di Hapus',
                                timeout: '2500',
                                transitionIn: 'flipInX',
                                transitionOut: 'flipOutX'
                            });
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                        }],
                    ],

                    onClosing: function (instance, toast, closedBy) {
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                });
            });
        })
    </script>
@endsection
