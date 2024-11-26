@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">Data Kelurahan Kecamatan {{Auth::user()->kecamatan->nama}}</h3>

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
              
              {{-- <th>Aksi</th> --}}
            </tr>
            @foreach ($data as $key => $item)
            <tr style="font-size: 18px">
              <td>
                <a href="/kecamatan/kelurahan/{{$item->id}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-eye"></i></a>
              </td>
              <td>{{1 + $key}}. {{$item->nama}}
               
              </td>
              <td style="font-weight: bold"> {{tpsmasuk($item->id)->count()}} / {{$item->suaratps->count()}}</td>
              <td>{{$item->suaratps->sum('nomor_1')}}</td>
              <td>{{$item->suaratps->sum('nomor_2')}}</td>
              <td>{{$item->suaratps->sum('nomor_3')}}</td>
            </tr>
            @endforeach
            {{-- <tr style="background-color: rgb(251, 213, 185); font-weight:bold;font-size:20px">
              <td></td>
              <td>TOTAL</td>
              <td>{{$data->sum('tpsmasuk')}} / {{$totalTPS}}</td>
              <td>{{$data->sum('nomor_1')}}</td>
              <td>{{$data->sum('nomor_2')}}</td>
              <td>{{$data->sum('nomor_3')}}</td>
            </tr> --}}
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
