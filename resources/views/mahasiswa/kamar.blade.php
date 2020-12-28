@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Kamar Asrama</div>
            <div class="card-body">
                @if ( !$room)
                    <h2>Anda Belum punya kamar</h2>
                @else
                    <h4 class="text-info">Anda Berada Di :</h4>
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 mb-2">
                            <h2 class="text-dark">Kamar : {{ $kamar->nama_ruangan }}</h2>
                            <h2 class="text-dark">Gedung Asrama : {{ $kamar->nama_gedung }}</h2>
                        </div>
                        <div class="col-xxl-6 col-xl-6 mb-2">
                            <h3 class="text-primary">Mulai : {{ date('d F Y',strtotime($kamar->mulai ))}}</h3>
                            <h3 class="text-primary">Akhir : {{ date('d F Y',strtotime($kamar->akhir )) }}</h3>
                        </div>
                    </div>
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

                        <button type="submit" name="submit" class="btn btn-primary btn-lg mt-3">
                            <b>Upload Files</b>
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
