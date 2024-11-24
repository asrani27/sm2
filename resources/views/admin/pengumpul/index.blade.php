@extends('layouts.app')
@push('css')
  <link rel="stylesheet" href="/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
<form class="form-horizontal" method="get" action="/superadmin/pengumpul/search">    
  @csrf
  <div class="col-sm-4">
      <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="nama" required>
  </div>
  <div class="col-sm-2">
      <button type="submit" class="btn btn-flat btn-primary btn-block"><i class="fa fa-search"></i> Cari</button> <br><br>
  </div>
</form>
<div class="row">
  <div class="col-md-12">
  </div>
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Petugas Pengumpul Data</h3>
            <div class="box-tools">
              <a href="/superadmin/pengumpul/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Telp</th>
                <th>Jumlah Data yg dikumpulkan</th>
                <th>Admin Yg Membuat</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                
                @foreach ($data as $key => $item)
                <tr>
                  <td>{{$data->firstItem() + $key}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->telp}}</td>
                  <td>{{$item->pilkada_count}}</td>
                  <td>{{$item->admin == null ? '-' : $item->admin->name}}</td>
                  
                  <td>
                    <a href="/superadmin/pengumpul/edit/{{$item->id}}/{{request()->get('page')}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                    <a href="/superadmin/pengumpul/delete/{{$item->id}}/{{request()->get('page')}}" class="btn btn-flat btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
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
