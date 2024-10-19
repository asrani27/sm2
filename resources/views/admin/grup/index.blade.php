@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Grup</h3>

            <div class="box-tools">
              <a href="/superadmin/timses/grup/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nama Grup</th>
                <th>Nama Koordinator</th>
                
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->koordinator}}</td>
                <td>
                  <a href="/superadmin/timses/grup/anggota/{{$item->id}}" class="btn btn-sm btn-primary"><i class="fa fa-users"></i> Anggota</a>
                  <a href="/superadmin/timses/grup/koordinator/{{$item->id}}" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Koordinator</a>
                  <a href="/superadmin/timses/grup/edit/{{$item->id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/timses/grup/delete/{{$item->id}}" class="btn btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
