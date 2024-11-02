<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>
</head>
<body>

    <h3>NAMA PENGUMPUL DATA : {{strtoupper($petugas->nama)}}</h3>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td>No</td>
            <td>Kelurahan</td>
            <td>Jumlah</td>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($data as $key => $item)
            <tr style="font-weight: bold; background-color:bisque">
                <td>{{$no++}}</td>
                <td>{{$key}}</td>
                <td>{{collect($item)->sum()}}</td>
            </tr>


            @foreach ($item as $rt => $jumlah)
            <tr>
            <td></td>
            <td>RT {{$rt}} - {{$jumlah}} orang</td>
            <td></td>
            </tr>
            @endforeach
        @endforeach
        <tr style="font-weight: bold; background-color:rgb(245, 179, 132)">
            <td></td>
            <td>TOTAL</td>
            <td>{{$data->map(function ($subCollection) {
                return $subCollection->sum(); // Menjumlahkan setiap sub-Collection
            })->sum()}}</td>
        </tr>
    </table>
</body>
</html>