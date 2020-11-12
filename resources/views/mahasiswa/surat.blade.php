@extends('layouts.navbar')

@section('content')
    <div class="container mt-1">
        <div class="card" style="width: 70%">
            <div class="card-header">Surat Asrama</div>
            <br>
            <div class="card-body" style="margin-right: 10%">
                <table class="table table-hover table-green-soft" id="datatable">
                    <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Surat Bebas Asrama</td>
                        <td><a href="{{ route('download') }}" class="btn-success btn-sm"> Download</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Surat Perjanjian</td>
                        <td><a href="{{ route('downloads') }}" class="btn-success btn-sm"> Download</a></td>
                    </tr>

                    </tbody>
                </table>
            </div>
@endsection

