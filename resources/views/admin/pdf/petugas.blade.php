<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>
</head>
<body>

    @php
    $no = 1;
    $nokel =1;
    @endphp
    @php
    $totalKeseluruhan = $data->sum(function ($rtGroups) {
        return $rtGroups->sum(function ($individuals) {
            return $individuals->count();
        });
    });
    @endphp
    <h3>NAMA PENGUMPUL DATA : {{strtoupper($petugas->nama)}}</h3>
    <h3>Total Keseluruhan: {{ $totalKeseluruhan }} orang</h3>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td>No</td>
            <td>Kelurahan</td>
            <td>Jumlah</td>
        </tr>

        @foreach ($data as $kelurahan => $rtGroups)
        @php
            $totalOrang = $rtGroups->sum(function ($individuals) {
                return $individuals->count();
            });
        @endphp
         <tr style="font-weight: bold; background-color:bisque">
            <td>{{$nokel ++}}</td>
            <td>{{ $kelurahan }}</td>
            <td>{{ $totalOrang }}</td>
         </tr>

    
        @foreach ($rtGroups as $rt => $individuals)
        @php
        $chunkedIndividuals = $individuals->chunk(30); // Membagi individu menjadi kelompok 30
        @endphp
            <tr>
                <td></td>
                <td>RT {{$rt}} - {{ $individuals->count() }} orang 
                    <div style="display: flex;">
                        @foreach ($chunkedIndividuals as $chunk)
                            <div style="flex: 1; margin-right: 20px;">
                                <ul>
                                    @foreach ($chunk as $index => $individual)
                                        <li>{{ $loop->iteration }}. {{ $individual['nama'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                {{-- @foreach ($chunkedIndividuals as $chunk)
                    <table border="0" cellpadding="0" cellspacong="0" style="font-size: 9px;font-weight:bold">
                        @foreach ($chunk as $index => $individual)
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $loop->iteration }}. {{ $individual['nama'] }}</td>
                        </tr>
                        @endforeach
                    </table>

                @endforeach --}}
                </td>
                <td></td>
            </tr>
        @endforeach
    @endforeach

        {{-- @foreach ($data as $key => $item)
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
        </tr> --}}
    </table>
</body>
</html>