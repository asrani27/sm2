@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data File DPT ({{$data->total()}})</h3>

            <div class="box-tools">
              <a href="#" class="btn btn-flat btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-upload"></i> Upload DPT</a>
              
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>File</th>
                
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->file}}</td>
                <td>
                  <a href="/storage/dpt/{{$item->file}}" target="_blank" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-download"></i> Download</a>
                  <a href="/superadmin/dpt/deletefile/{{$item->id}}" class="btn btn-flat btn-xs btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
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
        <h4 class="modal-title">Upload File DPT</h4>
      </div>
      <form action="/superadmin/dpt/uploadfile" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <input type="file" class="form-control" name="file[]" multiple required>
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
