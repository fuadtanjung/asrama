@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Data Mahasiswa</h1>
            </div>
            <!-- Date range picker example button-->
            <div class="btn btn-white btn-sm line-height-normal p-3" >
                <span>
                <h5>Total Mahasiswa :  <strong class="text-danger">{{ $mahasiswa->count() }}</strong> Orang </h5></span>
            </div>
        </div>
    </div>
    <div class="container mt-1">
        <div class="card">
            <div class="card-body">
                <div>
{{--                    <form action="{{ route('printtugas') }}" target="_blank" class="form-material" method="get">--}}
                    <button type="submit" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#print_tugasbulananmhs">
                        <i class="fa fa-print" style="margin-right: 7px"></i>Print Rekap Tugas Bulanan
                    </button>
{{--                    </form>--}}
                </div>
                <br>
                <table class="table table-hover table-bordered table-sm" id="datatable">
                    <thead style="text-align: center">
                    <tr>
                        <th >No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center" >
                    @foreach($mahasiswa as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a -> nim }}</td>
                            <td>{{ $a -> nama }}</td>
                            <td>
                                <a class="btn btn-outline-indigo btn-sm legitRipple" href="{{ route('tugasbulanan',[$a -> user_id]) }}">Tugas Bulanan</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="print_tugasbulananmhs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Print Tugas Bulanan Mahasiswa</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('printtugas') }}" method="post" target="_blank">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" class="form-control startmonth datetimepicker-input form-control-solid"
                                               data-toggle="datetimepicker" data-target=".startmonth" placeholder="Mulai" id="mulai" name="mulai"/>
                                        <br>
                                        <div class="input-group-append">
                                            <span class="input-group-text"> <b>s.d.</b></span>
                                        </div>
                                        <br>
                                        <input type="text" class="form-control endmonth datetimepicker-input form-control-solid"
                                               data-toggle="datetimepicker" data-target=".endmonth" placeholder="Akhir" id="akhir" name="akhir" />
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                            Close
                                        </button>
                                        <button class="btn btn-primary" type="submit">Print</button>
                                    </div>
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
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );

        $(document).ready(function(){
            setMonthRangePicker(".startmonth", ".endmonth")
        })
    </script>
@endsection
