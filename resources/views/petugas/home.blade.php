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
          <i class="fa fa-users"></i><h3 class="box-title">Selamat Datang, {{Auth::user()->name}}</h3>

          <div class="box-tools">
            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>


@endsection
@push('js')

@endpush
