@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Nomor ({{$data->total()}})</h3>

            <div class="box-tools">
              <a href="/superadmin/nomor/delete" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-trash"></i> Delete All</a>
              <a href="/superadmin/nomor/create" class="btn btn-flat btn-sm btn-primary"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-upload"></i> Upload</a>
              <a href="/superadmin/nomor/add" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-plus"></i> Nomor</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Jenis</th>
                
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->nomor}}</td>
                <td>{{$item->jenis}}</td>
                <td>
                  <a href="/superadmin/nomor/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/nomor/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Nomor</h4>
      </div>
      <form action="/superadmin/nomor/upload" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <input type="file" class="form-control" name="file" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@push('js')

@endpush
