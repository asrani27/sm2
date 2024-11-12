@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header text-white text-right" style="background: url('/logo/nomor3.jpeg') center center; background-size:cover; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">    
      </div>
      
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-12 border-right">
            <div class="description-block">
              <h1 class="description-headr">3,200</h1>
              <span class="description-text">Suara</span>
            </div>
            <!-- /.description-block -->
          </div>
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->
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
