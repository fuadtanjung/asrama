@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Kamar Asrama</div>
            <div class="card-body" style="margin-right: 10%">
                @if ( $room )
                    <h2>Anda Belum punya kamar</h2>
                @else
                    <h4 class="text-info">Anda Berada Di :</h4>
                    <h2 class="text-dark">Kamar : {{ $kamar->nama_ruangan }}</h2>
                    <h2 class="text-dark">Gedung Asrama : {{ $kamar->nama_gedung }}</h2>
                <br>
                <p>Tolong upload Surat Perjanjian Anda. Anda dapat dapat mendownload Surat tersebut pada menu <b>Surat Asrama</b></p>
                <form action="{{ route('suratperjanjian',[$kamar->ruangan_id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if ( count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div>
                            <input type="file" name="file" id="chooseFile">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary btn-sm btn-block mt-4">
                            Upload Files
                        </button>
                    </form>
                <div>
                    @endif
                    <br>
{{--                <b>Nama File : {{ $data->surat_perjanjian }}</b>--}}
{{--                    <small class="form-text text-muted">Nama File Akan Keliatan Apabila sudah upload.</small>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
