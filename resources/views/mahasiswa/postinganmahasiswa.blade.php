@extends('layouts.navbar')

@section('content')

    @foreach($post as $data)
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                            <h2 class="text-blue">{{ $data->judul }}
                            </div>
                            <div class="d-flex justify-content-between font-italic ">
                             <small> {{ date('j F, Y',strtotime($data->waktu_post)) }} </small>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ Str::limit($data->keterangan,100) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
