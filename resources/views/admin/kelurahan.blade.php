@extends('layouts.app')
@push('css')

@endpush
@section('content')

@include('admin.paslon')


<div class="row">
  <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">Data Kelurahan</h3>

          {{-- <div class="box-tools">
            <a href="/superadmin/kecamatan/create" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
          </div> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>No</th>
              <th>Nama Kelurahan</th>
              <th>Jumlah TPS</th>
              <th>Paslon 1</th>
              <th>Paslon 2</th>
              <th>Paslon 3</th>
              <th>Suara SAH</th>
              <th>Suara Tidak SAH</th>
              
              <th>Aksi</th>
            </tr>
            @foreach ($data as $key => $item)
            
            <tr>
              <td>{{1 + $key}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->tpsmasuk}} / {{$item->jumlah_tps}}</td>
              <td>{{$item->suaratps->sum('nomor_1')}}</td>
              <td>{{$item->suaratps->sum('nomor_2')}}</td>
              <td>{{$item->suaratps->sum('nomor_3')}}</td>
              <td>{{$item->suaratps->sum('nomor_1') + $item->suaratps->sum('nomor_2') + $item->suaratps->sum('nomor_3')}}</td>
              <td>{{$item->suaratps->sum('tidak_sah')}}</td>
              <td>
                <a href="/superadmin/suara/{{$kecamatan}}/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-eye"></i> detail</a>
              </td>
            </tr>
            @endforeach
            <tr style="background-color: rgb(251, 213, 185); font-weight:bold">
              <td></td>
              <td>TOTAL</td>
              <td>{{$data->sum('tpsmasuk')}} / {{$data->sum('jumlah_tps')}}</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>



@endsection
@push('js')


@endpush
