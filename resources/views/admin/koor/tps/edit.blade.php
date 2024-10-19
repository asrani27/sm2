@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<style>
  #map { height: 500px; }
</style>
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/koordinator/tps/detail/{{$kelurahan_id}}" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/koordinator/tps/edit/{{$data->id}}/{{$kelurahan_id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor TPS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor" value="{{$data->nomor}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIK Koordinator</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik" value="{{$data->nik}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Koordinator</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" value="{{$data->telp}}"  required>
                        </div>
                    </div>
                    
                    {{-- <div class="form-group">
                        <label class="col-sm-2 control-label">Lokasi</label>
                        <div class="col-sm-10">

                            <div id="map"></div>
                            <input type="text" class="form-control" name="lat" value="{{$data->lat}}" id="lat" readonly>
                            <input type="text" class="form-control" name="long" value="{{$data->long}}" id="long" readonly>
                        </div>
                    </div> --}}
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Update Data</button>
                </div>
                <!-- /.box-footer -->
            </form>
            
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')

@endpush