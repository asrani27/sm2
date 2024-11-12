@extends('layouts.app')
@push('css')

@endpush
@section('content')

@include('admin.paslon')


<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Panduan Cara Input!</h4>
            Silahkan tambah TPS terlebih dahulu, kemudian isi suara
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
            
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" value="{{$kecamatan == null ? '': $kecamatan->nama}}"  readonly>
                        </div>
                        <label class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nama" value="{{$kelurahan == null ? '': $kelurahan->nama}}"  readonly>
                        </div>
                    </div>
                    
                </div>
                
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" method="post" action="/superadmin/suara/{{$kecamatan->id}}/{{$kelurahan->id}}">
            @csrf
            <div class="col-sm-2">
                <input type="text" class="form-control" name="nomor_tps" placeholder="nomor TPS" minlength="3" maxlength="3"  onkeypress="return hanyaAngka(event)"/>
            </div>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah TPS</button> <br /><br />
            </div>
        </form>
    </div>
  <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">Data TPS</h3>

          {{-- <div class="box-tools">
            <a href="/superadmin/kecamatan/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
          </div> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>No</th>
              <th>Nomor TPS</th>
              <th>Paslon 1</th>
              <th>Paslon 2</th>
              <th>Paslon 3</th>
              
              <th>Aksi</th>
            </tr>
            @foreach ($data as $key => $item)
            <tr>
              <td>{{1 + $key}}</td>
              <td>{{$item->tps}}</td>
              <td>{{$item->nomor_1}}</td>
              <td>{{$item->nomor_2}}</td>
              <td>{{$item->nomor_3}}</td>
              <td>
                <a href="/superadmin/suara/{{$kecamatan->id}}/{{$kelurahan->id}}/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> isi</a>
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


@endpush
