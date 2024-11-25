<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data</title>
</head>
<body>
    Pengumpul Data : {{strtoupper($data->first()->pengumpul->nama)}}
    <br/><br/>
  <table class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0" style="font-size: 12px">
    <tbody>
    <tr>
      <th>No</th>
      <th>Kecamatan</th>
      <th>Kelurahan</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Usia</th>
      <th>RT</th>
      <th>RW</th>
      <th>TPS</th>
      
      
      {{-- <th>Aksi</th> --}}
    </tr>
    @foreach ($data as $key => $item)
    <tr>
      <td>{{1 + $key}}</td>
      <td>{{$item->kecamatan}}</td>
      <td>{{$item->kelurahan}}</td>
      <td>{{$item->nik}}</td>
      <td>{{$item->nama}}</td>
      <td>{{$item->usia}}</td>
      <td>{{$item->rt}}</td>
      <td>{{$item->rw}}</td>
      <td>{{$item->tps}}</td>
      
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>