@extends('layouts.app')
@push('css')
  <link rel="stylesheet" href="/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Saksi</h3>
            <div class="box-tools">
              {{-- <a href="/superadmin/pengumpul/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> --}}
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>TPS</th>
                <th>Nama & Telp</th>
                <th>Username & Password</th>
                
              </tr>
              </thead>
              <tbody>
                
                @foreach ($data as $key => $item)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$item->kecamatan}}</td>
                  <td>{{$item->kelurahan}}</td>
                  <td>{{$item->tps}}</td>
                  <td>{{$item->name}} {{$item->telp}}</td>
                  <td>{{$item->username}} {{$item->password}}</td>
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

<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush


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
        {{ $data->links('pagination::bootstrap-4') }}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
