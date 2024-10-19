<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <center>
        <h3>
            LAPORAN DATA DPT<br />
            NAMA KOORDINATOR : {{strtoupper($koordinator->nama)}}<br />
            NIK : {{$koordinator->nik}}
        </h3>
    </center>

    <table border=1 width="100%" cellspacing=0 cellpadding=0>
        <tr>
            <th style="padding: 15px 15px">No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Kelurahan</th>
            <th>RT</th>
        </tr>

        @foreach ($data as $key=> $item)

        <tr>
            <td style="padding: 5px 5px; text-align:center">{{$key+1}}</td>
            <td style="text-align: center">{{$item->nama}}</td>
            <td style="text-align: center">{{$item->nik}}</td>
            <td style="text-align: center">{{$item->kelurahan->nama}}</td>
            <td style="text-align: center">{{$item->rt}}</td>
        </tr>
        @endforeach
    </table>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
</body>

</html>