@extends('layouts.navbar')
@section('script')
    <script>
        $(document).ready(function(){
            @if(Session::has('success'))
            iziToast.success({
                title: 'Berhasil',
                position: 'topRight',
                message: '{{ Session::get('success') }}'
            });
            @endif
        });
    </script>
@endsection
