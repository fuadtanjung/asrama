@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Denda</div>
            <br>
            <div class="container-sm">
                <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_denda">
                    <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Tambah
                </button>
            </div>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ruangan as $data)
                    <tr>
                        <td>{{ $data->nama_ruangan }}</td>
                        <td><a class="btn btn-primary-soft" href="{{ route("kamar",$data->id) }}">Tambah Mahasiswa</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="input_denda" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Denda</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_denda" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">
                                        Nama Denda
                                    </label>
                                    <input class="form-control form-control-solid" id="nama_denda" name="nama_denda" type="text">
                                    <label for="exampleFormControlInput1">
                                        Jumlah Denda
                                    </label>
                                    <input class="form-control form-control-solid" id="denda" name="denda" type="number">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger legitRipple" type="button" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-primary" type="button" id="submit_denda" aksi="input">Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

