<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
        }
        .letak{

            margin-top: 20px;
            margin-left: 1%;
            margin-right: 1%;

        }
    </style>

</head>
<body>
<br><br>

<a style="text-align: center;margin-left: 200px"><h2>Rekap Absen Mahasiswa</h2></a>
<style type="text/css" media="print">
    @page {
        size: portrait;
    }
</style>

<div class="letak">
    <div >
        <table  class="table table-bordered table-sm" >
            <thead style="text-align: center">
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Ruangan</th>
                <th>Gedung</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody style="text-align: center">

            @foreach($absen as $data)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->nama_ruangan }}</td>
                <td>{{ $data->nama_gedung }}</td>
                <td>{{date('d-m-Y',strtotime($data->tanggal))}}</td>
                <td>{{ $data->keterangan }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
</div>


<script>
    window.onload = function() { window.print(); }
</script>

</body>
</html>

