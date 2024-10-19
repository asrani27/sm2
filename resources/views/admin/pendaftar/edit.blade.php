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
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Sahabat</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/pendaftar/edit/{{$data->id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <select name="kelurahan_id"class="form-control">
                                @foreach ($kelurahan as $item)
                                    
                                <option value="{{$item->id}}" {{$data->kelurahan_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik" minlength="16" maxlength="16" value="{{$data->nik}}"  readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="rt" value="{{$data->rt}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" value="{{$data->telp}}" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Anggota Grup?</label>
                        <div class="col-sm-10">
                            <select name="grup_id" class="form-control">
                                <option value="">-</option>
                            @foreach ($grup as $item)
                                <option value="{{$item->id}}" {{$data->grup_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                            @endforeach
                            </select>
                            jika bukan anggota grup, kosongkan 
                        </div>
                    </div>
                    
                    
                    
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Update</button>
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