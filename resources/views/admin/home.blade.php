@extends('layouts.app')
@push('css')

@endpush
@section('content')

@include('admin.paslon')


<div class="row">
  <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">Data Kecamatan</h3>

          {{-- <div class="box-tools">
            <a href="/superadmin/kecamatan/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
          </div> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>No</th>
              <th>Nama Kecamatan</th>
              <th>Jumlah TPS</th>
              <th>Paslon 1</th>
              <th>Paslon 2</th>
              <th>Paslon 3</th>
              
              <th>Aksi</th>
            </tr>
            @foreach ($kecamatan as $key => $item)
            
            <tr>
              <td>{{1 + $key}}</td>
              <td>{{$item->nama}}</td>
              <td>{{tpsmasukkecamatan($item->id)->count()}} / {{$item->kelurahan->sum('suaratps_count') }}</td>
              <td>{{$item->suaratps->sum('nomor_1')}}</td>
              <td>{{$item->suaratps->sum('nomor_2')}}</td>
              <td>{{$item->suaratps->sum('nomor_3')}}</td>
              <td>
                <a href="/superadmin/suara/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-eye"></i> detail</a>
              </td>
            </tr>
            @endforeach
            <tr style="background-color: rgb(251, 213, 185); font-weight:bold">
              <td></td>
              <td>TOTAL</td>
              <td>{{totaltpsmasuk()}} / {{$totalTPS}}</td>
              <td>{{$nomor1}}</td>
              <td>{{$nomor2}}</td>
              <td>{{$nomor3}}</td>
              <td></td>
            </tr>
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>


<div id="chartContainer" style="height: 370px; width: 100%;"></div>

@endsection
@push('js')

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script type="text/javascript">

var paslon1 = {!!json_encode($paslon1)!!}
var paslon2 = {!!json_encode($paslon2)!!}
var paslon3 = {!!json_encode($paslon3)!!}
  window.onload = function () {
  
  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title:{
      text: "Data Dalam Bentuk Grafik"
    },
    axisY: {
      title: "Suara",
      includeZero: true
    },
    legend: {
      cursor:"pointer",
      itemclick : toggleDataSeries
    },
    toolTip: {
      shared: true,
      content: toolTipFormatter
    },
    data: [{
      type: "bar",
      showInLegend: true,
      name: "Paslon 1",
      color: "#91c9ec",
      dataPoints: paslon1
    },
    {
      type: "bar",
      showInLegend: true,
      name: "Paslon 2",
      color: "#e8867f",
      dataPoints: paslon2
    },
    {
      type: "bar",
      showInLegend: true,
      name: "Paslon 3",
      color: "silver",
      dataPoints: paslon3
    }]
  });
  chart.render();
  
  function toolTipFormatter(e) {
    var str = "";
    var total = 0 ;
    var str3;
    var str2 ;
    for (var i = 0; i < e.entries.length; i++){
      var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
      total = e.entries[i].dataPoint.y + total;
      str = str.concat(str1);
    }
    str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
    return (str2.concat(str)).concat(str3);
  }
  
  function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    }
    else {
      e.dataSeries.visible = true;
    }
    chart.render();
  }
  
  }
  </script>
  
@endpush
