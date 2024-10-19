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
            <td colspan=2 style="text-align:center"><br/><strong><u>LAPORAN DATA PETUGAS</u></strong></td>
        </tr>
    </table>
    <br/>
    <table border=1 cellspacing="0" cellpadding="3" width="100%">
        <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Jabatan</th>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($data as $key => $item)
            <tr>
                <td style="text-align: center">{{$no++}}</td>
                <td style="text-align: center">{{$item->nama}}</td>
                <td style="text-align: center">{{$item->jabatan}}</td>
            </tr>
        @endforeach
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