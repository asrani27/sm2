<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <table border=0>
        <tr>
            <td width="15%" style="text-align: right">
                <img src="/logo/tl.png" width="60%">
            </td>
            <td style="text-align: center">
                <b>PEMERINTAH KABUPATEN TANAH LAUT<br/>
                DINAS PERHUBUNGAN<br/></b>
                A.Syairani Komplek Perkantoran Gagas, Pelaihari Kalimantan Selatan 72273

            </td>
        </tr>
        <tr>
            <td colspan=2 style="text-align:center"><br/><strong><u>HASIL PEMERIKSAAN</u></strong></td>
        </tr>
    </table>
    <br/>
    <table border=0 cellspacing="0" cellpadding="3" width="100%">
        <tr>
            <td>No Pemeriksaan </td>
            <td>: {{$data->nomor}}</td>
            <td>Tanggal Periksa</td>
            <td>: {{\Carbon\Carbon::parse($data->tanggal)->format('d-m-Y')}}</td>
        </tr>
        <tr>
            <td>No Polisi</td>
            <td>: {{$data->registrasi->nomor_polisi}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Pemilik</td>
            <td>: {{$data->registrasi->pemilik}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{$data->registrasi->alamat}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Jenis Kendaraan</td>
            <td>: {{$data->registrasi== null ? '': $data->registrasi->jenis->nama}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Merk</td>
            <td>: {{$data->registrasi->merk}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>: {{$data->registrasi->tahun}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nomor Mesin</td>
            <td>: {{$data->registrasi->nomor_mesin}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nomor Rangka</td>
            <td>: {{$data->registrasi->nomor_rangka}}</td>
            <td></td>
            <td></td>
        </tr>
        
        <tr>
            <td><br/><br/></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>1. Hasil Uji Peralatan</td>
            <td>: {{$data->uji_peralatan}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2. Hasil Uji Penerangan</td>
            <td>: {{$data->uji_penerangan}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3. Hasil Uji Kemudi</td>
            <td>: {{$data->uji_kemudi}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>4. Hasil Uji Chasis</td>
            <td>: {{$data->uji_chasis}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1. Hasil Uji Rangka</td>
            <td>: {{$data->uji_rangka}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>5. Hasil Uji Rem</td>
            <td>: {{$data->uji_rem}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>6. Hasil Uji Mesin</td>
            <td>: {{$data->uji_mesin}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>7. Hasil Uji Peralatan</td>
            <td>: {{$data->uji_peralatan}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <br/>HASIL PEMERIKSAAN</td>
            <td>: {{$data->hasil}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                Berlaku</td>
            <td>: 5 Tahun</td>
            <td></td>
            <td></td>
        </tr>
        @php
            $no =1;
        @endphp
        {{-- @foreach ($data as $key => $item)
            <tr>
                <td style="text-align: center">{{$no++}}</td>
                <td style="text-align: center">{{$item->tanggal}}</td>
                <td style="text-align: center">{{$item->nomor}}</td>
                <td style="text-align: center">{{$item->registrasi->nomor_polisi}}</td>
                <td style="text-align: center">{{$item->petugas->nama}}</td>
                <td style="text-align: center">{{$item->hasil}}</td>
            </tr>
        @endforeach --}}
    </table>
    <br/>
    <table width="100%">
        <tr>
            <td width="70%"></td>
            <td>
                Pelaihari, <br/>
                Kepala Dinas<br/><br/><br/><br/><br/>


                Andi Harahap, SH, MM<br/>
                NIP.197219900310002

            </td>
        </tr>
    </table>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

$(document).ready(function(){
    window.print();
});
</script>
</html>