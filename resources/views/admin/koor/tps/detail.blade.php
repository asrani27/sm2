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
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Panduan Cara Input!</h4>
            Silahkan tambah TPS terlebih dahulu, kemudian isi koordinator TPS, kemudian baru mengisi Koordinator KK.
          </div>
        {{-- <a href="/superadmin/koordinator/tps" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br /> --}}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Detail Informasi</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/koordinator/tps/edit/{{$data->id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" value="{{$data->kecamatan == null ? '': $data->kecamatan->nama}}"  readonly>
                        </div>
                        <label class="col-sm-2 control-label">Koordinator</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" value="{{$data->kecamatan->koor}} - {{$data->kecamatan->telp}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">kelurahan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}"  readonly>
                        </div>
                        <label class="col-sm-2 control-label">Koordinator</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" value="{{$data->koor}} - {{$data->telp}}"  readonly>
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
                {{-- <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Update Data</button>
                </div> --}}
                <!-- /.box-footer -->
            </form>
            
            <!-- /.box-body -->
        </div>
    </div>

    <div class="col-md-12">

        <form class="form-horizontal" method="post" action="/superadmin/koordinator/tps/detail/{{$data->id}}">
            @csrf
        <div class="col-sm-2">
            <input type="text" class="form-control" name="nomor_tps" placeholder="nomor TPS"  onkeypress="return hanyaAngka(event)"/>
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah TPS</button> <br /><br />
        </div>
        </form>
    </div>
            
        <!-- /.box -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Detail Koordinator TPS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>TPS</th>
                        <th>NIK Koordinator</th>
                        <th>Nama Koordinator</th>
                        <th>Telp</th>
                        <th>Jumlah Koordinator KK</th>
                        <th></th>
                    </tr>
                    @foreach ($data->tps->sortBy('nomor') as $key => $item)
                        
                    <tr>
                        <td>{{$item->nomor}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->telp}}</td>
                        <td>

                            <a href="/superadmin/koordinator/kk/detail/{{$item->id}}" class="btn btn-flat btn-sm btn-success">{{$item->keluarga->count()}} Koordinator KK</a>
                        </td>
                        <td>
                            
                            <a href="/superadmin/koordinator/tps/edit/{{$item->id}}/{{$data->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Edit Koor TPS</a>
                            <a href="/superadmin/koordinator/tps/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush