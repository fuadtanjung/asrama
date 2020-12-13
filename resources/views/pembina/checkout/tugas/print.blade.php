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

<a style="text-align: center;margin-left: 200px"><h2>Rekap Tugas Bulanan Mahasiswa</h2></a>
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
                    <th>Nama Tugas</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody style="text-align: center">
            @foreach($printtugas as $data)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->nama_tugas }}</td>
                <td>{{ $data->bulan }}</td>
                <td>{{ $data->tahun }}</td>
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
