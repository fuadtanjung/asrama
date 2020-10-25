@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Absen Sholat</div>
            <br>
            <form method="post" id="form_absen">
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" aksi="input" id="absen">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Absen
                </button>
            </div>
            <div class="card-body" style="margin-right: 10%">
                    @csrf
                    <table class="table table-hover table-green-soft table-bordered table-sm" id="data">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( $waktu -> count() <= 0)
                        @foreach( $mhs as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td><input type="checkbox" name="chkbox[]" value="{{ $data->user_id }}"></td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="3" style="text-align: center"> ABSEN HARI INI UDAH DI ISI</td>
                            </tr>
                        @endif
                        </tbody>
                </table>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox' ) {
                        checkboxes[i].checked = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }

        $(document).ready( function () {
            $('#data').DataTable();
        } );

        function resetFormdaftar() {
            $("#form_absen")[0].reset();
            $('#chk').val("").change();
            $('#chkbox').val("").change();
        }

        $('#absen').click(function () {
            var aksi = $("#absen").attr("aksi");
            $.ajax({
                url: "{{ url('absensholat/input') }}",
                type: "post",
                data: new FormData($('#form_absen')[0] ),
                async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (response) {
                    var pesan = JSON.parse(response);
                    if(pesan.error != null){
                        iziToast.error({
                            title: 'Gagal',
                            position: 'topRight',
                            message: pesan.error,
                        });
                        resetFormdaftar();
                    }else if(pesan.success != null){
                        iziToast.success({
                            title: 'Success notice',
                            position: 'topRight',
                            message: pesan.success
                        });
                        resetFormdaftar();
                    }else {
                        iziToast.warning({
                            title: 'Warning',
                            position: 'topRight',
                            message: "Can't retrieve any data from server",
                        });
                    }
                },
                fail: function () {
                    iziToast.error({
                        title: 'Error notice',
                        message: 'Gagal Menambahkan Data pengguna',
                        transitionOut: 'fadeOutUp'
                    });
                }
            });
        });
    </script>
@endsection
