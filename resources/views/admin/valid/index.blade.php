@extends('layouts.app')
@push('css')
  <link rel="stylesheet" href="/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">TOTAL SUARA TERPERCAYA</span>
        <span class="info-box-number">{{number_format($total_valid)}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 20%"></div>
        </div>
        <span class="progress-description">
              
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">TOTAL SUARA TIDAK TERPERCAYA</span>
        <span class="info-box-number">{{number_format($total_novalid)}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 20%"></div>
        </div>
        <span class="progress-description">
              
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
</div>
<div class="row">
  <form method="get" action="/superadmin/terpercaya/filter">
    @csrf
    
    <div class="col-lg-3">
      <div class="input-group input-group-md">
        <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{request('nama')}}">

        <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
        </div>
    </div>
  </form>
</div>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Terpercaya Dari Petugas Pengumpul Data</h3>
            <div class="box-tools">
              {{-- <a href="/superadmin/pengumpul/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> --}}
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <form action="/superadmin/terpercaya/valid" method="POST">
              @csrf
            <table class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Telp</th>
                <th>Jumlah Data yg dikumpulkan</th>
                <th>Admin Yg Membuat</th>
                <th></th>
                <th>
                  <button type="submit" class="btn btn-success btn-xs" name="button" value="valid"><i class="fa fa-check"></i> Valid</button>
                  <button type="submit" class="btn btn-danger btn-xs" name="button" value="novalid"><i class="fa fa-times"></i> Tidak Valid</button><br/>
                  <input type="checkbox" id="selectAll"> Check All
                </th>
              </tr>
              </thead>
              <tbody>
                
                @foreach ($data as $key => $item)
                @if ($item->valid === 1)
                    <tr style="background-color: rgb(209, 244, 211)">
                @else
                    <tr style="background-color: rgb(237, 209, 209)">
                    
                @endif
                  <td>{{$key + 1}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->telp}}</td>
                  <td>{{$item->pilkada_count}}</td>
                  <td>{{$item->admin == null ? '-' : $item->admin->name}}</td>
                  
                  <td>
                    <a href="/superadmin/terpercaya/preview/{{$item->id}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-search"></i> preview</a>
                    <a href="/superadmin/terpercaya/valid/{{$item->id}}" class="btn btn-flat btn-xs btn-success"><i class="fa fa-check"></i> Valid</a>
                    <a href="/superadmin/terpercaya/novalid/{{$item->id}}" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-times"></i> Tidak Valid</a>
                  </td>
                  <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="checkbox-item"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </form>
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

<script>
  // Fungsi untuk memilih semua checkbox
  document.getElementById('selectAll').addEventListener('click', function() {
      // Dapatkan semua checkbox item
      let checkboxes = document.querySelectorAll('.checkbox-item');
      // Ubah status checkbox item sesuai dengan checkbox "Select All"
      checkboxes.forEach((checkbox) => {
          checkbox.checked = this.checked;
      });
  });
</script>
@endpush
