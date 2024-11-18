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
        <a href="/superadmin/suara/{{$kecamatan->id}}/{{$kelurahan->id}}" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Isi Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/suara/{{$kecamatan->id}}/{{$kelurahan->id}}/{{$data->id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kecamatan" value="{{$kecamatan->nama}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kelurahan" value="{{$kelurahan->nama}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor TPS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tps" value="{{$data->tps}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Saksi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="saksi" value="{{$data->saksi}}" placeholder="nama saksi">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="telp" value="{{$data->telp}}" placeholder="no telp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jumlah Suara Paslon 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_1" value="{{$data->nomor_1}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jumlah Suara Paslon 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_2" value="{{$data->nomor_2}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jumlah Suara Paslon 3</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_3" value="{{$data->nomor_3}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Suara SAH</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sah" value="{{$data->sah}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Suara Tidak Sah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tidak_sah" value="{{$data->tidak_sah}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="file">
                        </div>
                    </div>
                    
                    
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