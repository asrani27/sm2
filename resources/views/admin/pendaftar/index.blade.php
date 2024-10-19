@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row text-right">
  <div class="col-md-12">
  <a href="/superadmin/pendaftar/create" class="btn btn-primary"><i class="fa fa-user"></i> Tambah Sahabat</a><br/><br/>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Sahabat </h3>

            <div class="box-tools">
              <form class="form" method="get" action="/superadmin/pendaftar/cari">
                  <div class="input-group input-group-sm hidden-xs" style="width: 350px;">
                  <input type="text" name="cari" class="form-control pull-right" placeholder="Cari NIK/Nama" value="{{old('cari')}}">
      
                  <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                  </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>RT</th>
                
                {{-- <th>Aksi</th> --}}
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->kelurahan == null ? '' :$item->kelurahan->kecamatan->nama}}</td>
                <td>{{$item->kelurahan == null ? '' : $item->kelurahan->nama}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->rt}}</td>
                <td>
                  <a href="/superadmin/pendaftar/edit/{{$item->id}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/pendaftar/delete/{{$item->id}}" class="btn btn-flat btn-xs btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->withQueryString()->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
