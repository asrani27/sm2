<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>
</head>
<body>

    <h3>KELURAHAN : {{strtoupper($kelurahan)}}</h3>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td>No RT</td>
            <td>Jumlah Terdata</td>
            <td>Jumlah Belum Di Data</td>
            <td>Total</td>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($data as $key => $item)
            <tr>
                <td>{{$item->rt}}</td>
                <td>{{$item->jumlah_terdata}}</td>
                <td>{{$item->jumlah_belum_terdata}}</td>
                <td>{{$item->total}}</td>
            </tr>
        @endforeach
        <tr style="font-weight: bold; background-color:rgb(245, 179, 132)">
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td>{{$data->sum('total')}}</td>
        </tr>
    </table>
</body>
</html>