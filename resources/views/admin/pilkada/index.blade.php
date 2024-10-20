@extends('layouts.app')
@push('css')


@endpush
@section('content')
<div class="row">
  <form method="post" action="/superadmin/pilkada/pengumpul">
    @csrf
    <div class="col-lg-3">
      <select class="form-control" name="pengumpul_id" required>
        <option value="">-petugas-</option>
        @foreach (pengumpul() as $item)
            <option value="{{$item->id}}" {{pengumpul_aktif() == $item->id ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-6">
      <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> save</button>
    </div>
  </form>
</div>
<hr>
<div class="row">
  <form method="get" action="/superadmin/pilkada/filter">
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
    <div class="col-lg-2">
      <div class="input-group input-group-md hidden-xs" style="width: 350px;">
        <input type="text" name="nama" class="form-control pull-right" placeholder="Cari Nama" value="{{request('nama')}}">

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
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data DPT Pilkada</h3>

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
                  @if ($item->pengumpul_id === null)
                      <a href="/superadmin/pilkada/pendukung/{{$item->id}}" class="btn btn-xs btn-default pilih"><i class="fa fa-check"></i></a>
                  @else
                  <a href="/superadmin/pilkada/pendukung/{{$item->id}}" class="btn btn-xs btn-success pilih"><i class="fa fa-check"></i></a>
                  <a href="/superadmin/pilkada/pendukung/delete/{{$item->id}}" class="btn btn-xs btn-danger pilih" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                  @endif
                </td>
                {{-- <td>
                  <a href="/superadmin/dpt/edit/{{$item->id}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/dpt/delete/{{$item->id}}" class="btn btn-flat btn-xs btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td> --}}
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

<div class="row">
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Pendukung/Total DPT</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{number_format(pendukung())}} / {{number_format(totalDPT())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Banjarmasin Timur</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{number_format(pendukungTimur())}} / {{number_format(totalBjmTimur())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Banjarmasin Barat</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{number_format(pendukungBarat())}} / {{number_format(totalBjmBarat())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Banjarmasin Tengah</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{number_format(pendukungTengah())}} /{{number_format(totalBjmTengah())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Banjarmasin Utara</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{number_format(pendukungUtara())}} /{{number_format(totalBjmUtara())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Banjarmasin Selatan</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{number_format(pendukungSelatan())}} /{{number_format(totalBjmSelatan())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

@endsection
@push('js')

@endpush
