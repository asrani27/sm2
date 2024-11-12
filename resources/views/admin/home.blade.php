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
              <th>Paslon 1</th>
              <th>Paslon 2</th>
              <th>Paslon 3</th>
              
              <th>Aksi</th>
            </tr>
            @foreach (kecamatan() as $key => $item)
            <tr>
              <td>{{1 + $key}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->suaratps->sum('nomor_1')}}</td>
              <td>{{$item->suaratps->sum('nomor_2')}}</td>
              <td>{{$item->suaratps->sum('nomor_3')}}</td>
              <td>
                <a href="/superadmin/suara/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-eye"></i> detail</a>
              </td>
            </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>

{{-- <a href="/superadmin/refresh" class="btn btn-md btn-danger"><i class="fa fa-refresh"></i>&nbsp;Refresh</a><br/><br/>
<div class="row">
  <div class="col-md-8">
  <div class="box">  
      <div class="box-body no-padding ">  
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="box">  
      <div class="box-body no-padding ">  
        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
      </div>
  </div>
  </div>

</div>
<div class="row">
  
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total DPT Kota Banjarmasin</span>
        <span class="info-box-number">{{number_format($kecamatan->sum('dpt'))}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  @foreach ($kecamatan as $item)
      
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">DPT {{strtoupper($item->nama)}}</span>
        <span class="info-box-number">{{number_format($item->dpt)}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  @endforeach
  
</div> --}}

@endsection
@push('js')

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>

  var kecamatan = {!!json_encode($kecamatan)!!}
  var dpt = {!!json_encode($dpt)!!}
  var sahabat = {!!json_encode($sahabat)!!}
  
  </script>

<script>
  window.onload = function () {
  
  var chart = new CanvasJS.Chart("chartContainer", {
    exportEnabled: true,
    animationEnabled: true,
    title:{
      text: "DPT Per Kecamatan"
    },
    subtitles: [{
      text: "Prediksi Data Sahabat Dengan Data DPT"
    }], 
    axisX: {
      title: "Kecamatan"
    },
    axisY: {
      title: "DPT Terdaftar",
      titleFontColor: "#4F81BC",
      lineColor: "#4F81BC",
      labelFontColor: "#4F81BC",
      tickColor: "#4F81BC",
      includeZero: true
    },
    axisY2: {
      title: "Data Sahabat",
      titleFontColor: "#C0504E",
      lineColor: "#C0504E",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E",
      includeZero: true
    },
    toolTip: {
      shared: true
    },
    legend: {
      cursor: "pointer",
      itemclick: toggleDataSeries
    },
    data: [{
      type: "column",
      name: "DPT Terdaftar",
      showInLegend: true,      
      yValueFormatString: "#,##0.# Org",
      dataPoints: [
        { label: "BJM BARAT",  y: kecamatan[0].dpt },
        { label: "BJM SELATAN", y: kecamatan[1].dpt },
        { label: "BJM TIMUR", y: kecamatan[2].dpt },
        { label: "BJM TENGAH",  y: kecamatan[3].dpt },
        { label: "BJM UTARA",  y: kecamatan[4].dpt }
      ]
    },
    {
      type: "column",
      name: "Sahabat",
      axisYType: "secondary",
      showInLegend: true,
      yValueFormatString: "#,##0.# Org",
      dataPoints: [
        { label: "BJM BARAT",  y: kecamatan[0].sahabat },
        { label: "BJM SELATAN", y: kecamatan[1].sahabat },
        { label: "BJM TIMUR", y: kecamatan[2].sahabat },
        { label: "BJM TENGAH",  y: kecamatan[3].sahabat },
        { label: "BJM UTARA",  y: kecamatan[4].sahabat }
      ]
    }]
  });
  chart.render();
  
  function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    } else {
      e.dataSeries.visible = true;
    }
    e.chart.render();
  }
  

  var chart2 = new CanvasJS.Chart("chartContainer2", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "DPT Kota Banjarmasin"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}</strong>",
		indexLabel: "{name} - {y}",
		dataPoints: [
			{ y: dpt, name: "DPT Terdaftar ", exploded: true },
			{ y: sahabat, name: "Sahabat " },
		]
	}]
});
chart2.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart2.render();

  }
  </script>
@endpush
