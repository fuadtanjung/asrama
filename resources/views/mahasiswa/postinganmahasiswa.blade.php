@extends('layouts.navbar')

@section('content')

    @foreach($post as $data)
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            {{ $data->judul }}
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
