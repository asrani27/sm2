@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Koordinator TPS</h3>

            <div class="box-tools">
              {{-- <a href="/superadmin/kecamatan/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> --}}
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <tbody>
              <tr style="background-color: beige">
                <th>No</th>
                <th>Nama Kelurahan</th>
                <th>Total TPS</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{1 + $key}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->tps->count()}}</td>
                <td>
                  <a href="/superadmin/koordinator/tps/detail/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Koordinator TPS</a>
                  {{-- <a href="/superadmin/kecamatan/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a> --}}
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{-- {{$data->links()}} --}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
