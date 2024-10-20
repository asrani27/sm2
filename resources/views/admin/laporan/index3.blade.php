@extends('layouts.app')
@push('css')


@endpush
@section('content')
<div class="row">
  
    <div class="col-lg-3">
      <h2>LAPORAN</h2>
    </div>
</div>
<hr>
<div class="row">
  <form method="get" action="/superadmin/laporan/filter">
    @csrf
    <div class="col-lg-3">
      <select class="form-control" name="kecamatan">
        <option value="">-kecamatan-</option>
        @foreach (kecamatan() as $item)
            <option value="{{$item->nama}}" {{request('kecamatan') == $item->nama ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-3">
      <select class="form-control" name="kelurahan">
        <option value="">-kelurahan-</option>
        @foreach (kelurahan() as $item)
            <option value="{{$item->nama}}"  {{request('kelurahan') == $item->nama ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-1">
      <div class="input-group input-group-md hidden-xs">
        <input type="text" name="rt" class="form-control pull-right" placeholder="RT" value="{{request('rt')}}">
      </div>
    </div>
    <div class="col-lg-1">
      <div class="input-group input-group-md hidden-xs">
        <input type="text" name="tps" class="form-control pull-right" placeholder="TPS" value="{{request('tps')}}">

       </div>
    </div>
    <div class="col-lg-1">
      <select class="form-control" name="list">
        <option value="10" {{request('list') == '10' ? 'selected':''}}>10</option>
        <option value="25" {{request('list') == '25' ? 'selected':''}}>25</option>
        <option value="50" {{request('list') == '50' ? 'selected':''}}>50</option>
        <option value="100" {{request('list') == '100' ? 'selected':''}}>100</option>
        
      </select>
    </div>
    <div class="col-lg-1">
      <div class="input-group input-group-md hidden-xs">
        <button tpe="submit" class="btn btn-md btn-primary"><i class="fa fa-search"></i> FILTER</button>
       </div>
    </div>
    
  </form>
</div>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Laporan</h3>

            {{-- <div class="box-tools">
              <form class="form" method="get" action="/superadmin/dpt/cari">
                  <div class="input-group input-group-sm hidden-xs" style="width: 350px;">
                  <input type="text" name="cari" class="form-control pull-right" placeholder="Cari NIK/Nama" value="{{old('cari')}}">
      
                  <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                  </div>
              </form>
            </div> --}}
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <tbody>
              <tr style="background-color:bisque">
                <th>No</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>RT</th>
                <th>RW</th>
                <th>TPS</th>
                <th>Pengumpul Data</th>
                <td></td>
                
                {{-- <th>Aksi</th> --}}
              </tr>
              @foreach ($data as $key => $item)
              @if ($item->sahabat == 1)
              <tr style="background-color: #b0deb0">
              @else
              <tr>
              @endif
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->kecamatan}}</td>
                <td>{{$item->kelurahan}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->usia}}</td>
                <td>{{$item->rt}}</td>
                <td>{{$item->rw}}</td>
                <td>{{$item->tps}}</td>
                <td>{{$item->pengumpul == null ? null : $item->pengumpul->nama}}</td>
                <td class="text-center">
                  
                </td>
                
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->withQueryString()->links()}}
        <!-- /.box -->
      </div>
</div>

@if ($gt != null)
    
<div class="row">
  <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <td>No</td>
              <td>Nama Pengumpul Data</td>
              <td>Telp</td>
              <td>Jumlah Yang Di Data</td>
            </tr>
            
            @foreach ($gt->get() as $key => $item)
                <tr>
                  <td>{{$key +1}}</td>
                  <td>{{$item->pengumpul_id == null ? 'Belum di data' : $item->pengumpul->nama}}</td>
                  <td>{{$item->pengumpul_id == null ? '-' : $item->pengumpul->telp}}</td>
                  <td>{{number_format($item->total)}}</td>
                </tr>
            @endforeach
            <tr>
              <td colspan="3">JUMLAH DPT</td>
              <td>{{$gt->get()->sum('total')}}</td>
            </tr>
          </table>
        </div>
      </div>
  </div>
</div>
@endif
@endsection
@push('js')

@endpush
