<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Preview</title>
</head>
<body>
  
  <table class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0" style="font-size: 12px">
    <tbody>
    <tr style="background-color:bisque">
      <th>No</th>
      <th>Kecamatan</th>
      <th>Kelurahan</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Usia</th>
      <th>RT</th>
      <th>RW</th>
      <th>TPS</th>
      <th>Pengumpul Data</th>
      <td></td>
      
      {{-- <th>Aksi</th> --}}
    </tr>
    @foreach ($data as $key => $item)
    @if ($item->pengumpul != null)
    <tr style="background-color: #d9f3d9">
    @else
    <tr>
    @endif
      <td>{{1 + $key}}</td>
      <td>{{$item->kecamatan}}</td>
      <td>{{$item->kelurahan}}</td>
      <td>{{$item->nik}}</td>
      <td>{{$item->nama}}</td>
      <td>{{$item->usia}}</td>
      <td>{{$item->rt}}</td>
      <td>{{$item->rw}}</td>
      <td>{{$item->tps}}</td>
      <td>{{$item->pengumpul == null ? null : $item->pengumpul->nama}}</td>
      <td class="text-center">
        
      </td>
      
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>
