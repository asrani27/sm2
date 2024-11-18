<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>
</head>
<body>

    <h3>LAPORAN PENGUMPUL DATA </h3>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Telp</th>
            <th>Jumlah Data yg dikumpulkan</th>
            <th>Admin Yg Membuat</th>
        </tr>
        @php
            $no =1;
        @endphp
        
        @foreach ($data as $key => $item)
        <tr>
          <td>{{$key + 1}}</td>
          <td>{{$item->nama}}</td>
          <td>{{$item->telp}}</td>
          <td>{{$item->pilkada_count}}</td>
          <td>{{$item->admin == null ? '-' : $item->admin->name}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>