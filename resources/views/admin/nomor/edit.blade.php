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
        <a href="/superadmin/nomor" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Nomor</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/nomor/edit/{{$data->id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor" value="{{$data->nomor}}"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis</label>
                        <div class="col-sm-10">
                            <select name="jenis" class="form-control" required>
                                <option value="">-pilih-</option>
                                <option value="MASYARAKAT" {{$data->jenis == "MASYARAKAT" ? 'selected':''}}>MASYARAKAT</option>
                                <option value="ASN" {{$data->jenis == "ASN" ? 'selected':''}}>ASN</option>
                                <option value="NON ASN" {{$data->jenis == "NON ASN" ? 'selected':''}}>NON ASN</option>
                                <option value="BJM UTARA" {{$data->jenis == "BJM UTARA" ? 'selected':''}}>BJM UTARA</option>
                            </select>
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