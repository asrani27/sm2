@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data User</h3>

            <div class="box-tools">
              <a href="/superadmin/user/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->roles->first()->name}}</td>
                <td>
                  @if ($item->name === 'admin')
                      
                  @else
                  <a href="/superadmin/user/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/user/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                  @endif
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
