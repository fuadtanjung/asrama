@extends('layouts.navbar')

@section('content')
    <div class="container mt-4">
        <div class="card" style="width: 70%">
            <div class="card-header">Profile Akun</div>
            <div>
            @if ( auth()->user()->role->nama == "pembina" && $pembina->isEmpty())
            <div class="card-body">
                <div class="container-sm">
                    <button type="button" class="btn btn-primary btn-sm legitRipple" data-toggle="modal" data-target="#input_pembina">
                        <i class="fa fa-plus-circle" style="margin-right: 7px"></i>Isi Profile
                    </button>
                </div>
            </div>
            @elseif ( auth()->user()->role->nama == "pembina" && $pembina->isNotEmpty())
            <div class="card-body" style="margin-right: 10%">
                <form id="form_pembina" method="post">
                    @csrf
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->pembina->nim}}">
                        <label>Nama</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->pembina->nama }}" >

                         <label>Pembina Tahun</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->pembina->pembina_tahun->tahun }}" >

                        <label>Pembina Gedung</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->pembina->pembina_tahun->pembina_gedung->gedung->nama_gedung }}" >

                        <label>Pekerjaan</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" value="{{ auth()->user()->pembina->pekerjaan }}">

                        <label>No. Hp</label>
                        <input type="text" class="form-control form-control-solid form-control-sm"  value="{{ auth()->user()->pembina->no_hp }}">

                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->pembina->tempat_lahir }}">

                        <label> Tanggal Lahir</label>
                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ date('d-m-Y',strtotime( auth()->user()->pembina->tanggal_lahir))}}">

                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control  form-control-solid form-control-sm" value="{{ auth()->user()->pembina->jenis_kelamin}}">

                        <label>Alamat</label>
                        <textarea class="form-control  form-control-solid form-control-sm" >{{ auth()->user()->pembina->alamat_asal}}</textarea>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
