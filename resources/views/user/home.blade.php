@extends('layouts.app2')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<style>
  #map { height: 800px; }
</style>
@endpush
@section('content')

<div class="row">
  <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header">
          <i class="fa fa-users"></i><h3 class="box-title">Data Kenalan Yang anda ajak</h3>

          <div class="box-tools">
            <a href="/user/sm/create" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-plus"></i> Input Data</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Kelurahan</th>
              <th>RT</th>
              <th>Aksi</th>
            </tr>
            @foreach ($data as $key => $item)
            <tr>
              <td>{{1 + $key}}</td>
              <td>{{$item->nik}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->kelurahan->nama}}</td>
              <td>{{$item->rt}}</td>
              
              <td>
                {{-- <a href="/user/sm/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> --}}
                <a href="/user/sm/delete/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
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


@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>
<script>
  var map = L.map('map').setView([-3.327460, 114.588515], 14);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 24,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
</script>
@endpush
