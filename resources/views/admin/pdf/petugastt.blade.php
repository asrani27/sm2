<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>

<style>
    @media print {
        footer {
            display: none; /* Menghilangkan seluruh footer */
        }

        /* Atau jika Anda hanya ingin menyembunyikan link tertentu */
        footer a {
            display: none; /* Menghilangkan hanya link dalam footer */
        }
    }
</style>
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
            <td></td>
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
            <td></td>
         </tr>

    
        @foreach ($rtGroups as $rt => $individuals)

        @php

        $nomorUrut = 1; 
        $totalIndividuals = $individuals->count();
        $chunkSize = ceil($totalIndividuals / 5); // Hitung ukuran chunk
        $chunkedIndividuals = $individuals->chunk($chunkSize);
        
        @endphp
            <tr>
                <td></td>
                <td>RT {{$rt}} - {{ $individuals->count() }} orang 
                    <div style="display: flex;">
                        @foreach ($chunkedIndividuals as $chunk)
                            <div style="flex: 1; margin-right: 20px;">
                                <ul>
                                    @foreach ($chunk as $index => $individual)
                                        <li style="font-size: 14px">{{ $nomorUrut }}. {{ $individual['nama'] }}</li>
                                        @php $nomorUrut++; @endphp
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td></td>
                <td>
                    @php
                        
                    $tidakterdata = tidakterdata($kelurahan, $rt)->chunk(20);
                    
                    @endphp
                    Tidak terdata :
                    <div style="display: flex; flex-wrap: wrap;">
                        @foreach ($tidakterdata as $chunktidakterdata)
                            <ul style="flex: 1 1 20%; list-style-type: none; padding-left: 0;">
                                @foreach ($chunktidakterdata as $indextt=> $itemtt)
                                    <li style="font-size: 10px;">{{ $loop->parent->iteration * 20 - 19 + $indextt }}. {{$itemtt->nama}}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </td>
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