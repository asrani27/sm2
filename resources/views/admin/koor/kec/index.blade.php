@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Koordinator Kecamatan</h3>

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
                <th>Nama Kecamatan</th>
                <th>NIK Koordinator</th>
                <th>Nama Koordinator</th>
                <th>No Telp</th>
                
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->koor}}</td>
                <td>{{$item->telp}}</td>
                <td>
                  <a href="/superadmin/koordinator/kecamatan/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Edit Koor</a>
                  {{-- <a href="/superadmin/kecamatan/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a> --}}
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
