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
            <td rowspan="2">No RT</td>
            <td colspan="2">Terdata</td>
            <td colspan="2">Belum Di Data</td>
            <td rowspan="2">Total</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>Persentase</td>
            <td>Jumlah</td>
            <td>Persentase</td>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($data as $key => $item)
        @if ((int)$item->persentase_terdata < 40)
            
        <tr style="font-weight: bold; background-color:rgb(249, 190, 179)">
        @else
            
        <tr>
        @endif
                <td>{{$item->rt}}</td>
                <td>{{$item->jumlah_terdata}}</td>
                <td>{{(int)$item->persentase_terdata}} %</td>
                <td>{{$item->jumlah_belum_terdata}}</td>
                <td>{{(int)$item->persentase_belum_terdata}} %</td>
                <td>{{$item->total}}</td>
            </tr>
        @endforeach
        <tr style="font-weight: bold; background-color:rgb(182, 170, 162)">
            <td>TOTAL</td>
            <td>{{$data->sum('jumlah_terdata')}}</td>
            <td>{{ROUND(($data->sum('jumlah_terdata')/$data->sum('total')) * 100)}} %</td>
            <td>{{$data->sum('jumlah_belum_terdata')}}</td>
            <td>{{ROUND(($data->sum('jumlah_belum_terdata')/$data->sum('total')) * 100)}} %</td>
            <td>{{$data->sum('total')}}</td>
        </tr>
    </table>
</body>
</html>