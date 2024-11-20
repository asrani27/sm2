@extends('layouts.app')
@push('css')

  <!-- Select2 -->
  <link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">

@endpush
@section('content')
<div class="row">
  <form method="post" action="/superadmin/pilkada/pengumpul">
    @csrf
    <div class="col-lg-3">
      <select class="form-control select2" name="pengumpul_id" required>
        <option value="">-petugas-</option>
        @foreach (pengumpul() as $item)
            <option value="{{$item->id}}" {{Auth::user()->pengumpul_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
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
  <form method="get" action="/superadmin/validpilkada/filter">
    @csrf
    <div class="col-lg-2">
      <select class="form-control select2" name="kecamatan">
        <option value="">-kecamatan-</option>
        @foreach (kecamatan() as $item)
            <option value="{{$item->nama}}" {{request('kecamatan') == $item->nama ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-2">
      <select class="form-control select2" name="kelurahan">
        <option value="">-kelurahan-</option>
        @foreach (kelurahan() as $item)
            <option value="{{$item->nama}}"  {{request('kelurahan') == $item->nama ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-1">
        <input type="text" name="rt" class="form-control" placeholder="RT" value="{{request('rt')}}">
    </div>
    <div class="col-lg-1">
        <input type="text" name="tps" class="form-control" placeholder="TPS" value="{{request('tps')}}">
    </div>
    <div class="col-lg-1">
      <select class="form-control" name="list">
        <option value="10" {{request('list') == '10' ? 'selected':''}}>10</option>
        <option value="25" {{request('list') == '25' ? 'selected':''}}>25</option>
        <option value="50" {{request('list') == '50' ? 'selected':''}}>50</option>
        <option value="100" {{request('list') == '100' ? 'selected':''}}>100</option>
      </select>
    </div>

    <div class="col-lg-2">
      <select class="form-control select2" name="petugas">
        <option value="">-petugas-</option>
        @foreach (pengumpulvalid() as $item)
            <option value="{{$item->id}}" {{request('petugas') == $item->id ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-3">
      <div class="input-group input-group-md">
        <input type="text" name="nama" class="form-control" placeholder="NIK / Nama" value="{{request('nama')}}">

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
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="/superadmin/validpilkada/kuncisemua" method="POST">
              @csrf
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
                <td>
                  <button type="submit" class="btn btn-danger btn-xs" name="button" value="kunci"><i class="fa fa-lock"></i> Kunci</button>
                  <button type="submit" class="btn btn-success btn-xs" name="button" value="buka"><i class="fa fa-unlock"></i> Buka</button><br/>
                  <input type="checkbox" id="selectAll"> Check All
                </td>
                
                {{-- <th>Aksi</th> --}}
              </tr>
              @foreach ($data as $key => $item)
              @if ($item->kunci === 1)
                <tr style="background-color: #c0ebf9">
              @else
                @if ($item->pengumpul_id != null)
                <tr style="background-color: #d9f3d9">
                @else
                <tr>
                @endif
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

                  @if ($item->kunci === 1)
                      {{-- @if (Auth::user()->username === 'admin') --}}
                      <a href="/superadmin/pilkada/bukakunci/{{$item->id}}" class="btn btn-xs btn-danger"><i class="fa fa-lock"></i> Buka</a>
                      {{-- @endif --}}
                  @else

                      {{-- @if (Auth::user()->username === 'admin') --}}
                      <a href="/superadmin/pilkada/kunci/{{$item->id}}" class="btn btn-xs btn-primary"><i class="fa fa-lock"></i> kunci</a>
                      {{-- @endif --}}
                    @if ($item->pengumpul_id === null)
                        <a href="/superadmin/pilkada/pendukung/{{$item->id}}" class="btn btn-xs btn-default"><i class="fa fa-check"></i></a>
                    @else
                    <a href="/superadmin/pilkada/pendukung/{{$item->id}}" class="btn btn-xs btn-success" onclick="return confirm('data ini sudah terisi, apakah anda ingin mengubah?');"><i class="fa fa-check"></i></a>
                    <a href="/superadmin/pilkada/pendukung/delete/{{$item->id}}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                    @endif
                  @endif
                </td>
                <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="checkbox-item"></td>
                {{-- <td>
                  <a href="/superadmin/dpt/edit/{{$item->id}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/dpt/delete/{{$item->id}}" class="btn btn-flat btn-xs btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
            </table>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->withQueryString()->links()}}
        <!-- /.box -->
      </div>
</div>

<div class="row">
  <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">Petugas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          @if ($jumlahPerPetugas != null)
              
          <ul>
            @foreach ($jumlahPerPetugas as $key => $item)
                <li>{{$item['petugas'] == null ? 'no-petugas' : $item['petugas']}} : {{$item['total']}}</li>
            @endforeach
            </ul>
          @endif
          
        </div>
      </div>
  </div>
</div>

@if (Auth::user()->username == 'admin')
    
<div class="row">
  <div class="col-md-3">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Pendukung/Total DPT</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <span style="font-size:16px; font-weight:bold">{{$data->total()}} / {{number_format(totalDPT())}}</span>
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
        <span style="font-size:16px; font-weight:bold">{{$data->where('kecamatan','BANJARMASIN TIMUR')->count()}} / {{number_format(totalBjmTimur())}}</span>
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
        <span style="font-size:16px; font-weight:bold">{{$data->where('kecamatan','BANJARMASIN BARAT')->count()}} / {{number_format(totalBjmBarat())}}</span>
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
        <span style="font-size:16px; font-weight:bold">{{$data->where('kecamatan','BANJARMASIN TENGAH')->count()}} /{{number_format(totalBjmTengah())}}</span>
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
        <span style="font-size:16px; font-weight:bold">{{$data->where('kecamatan','BANJARMASIN UTARA')->count()}} /{{number_format(totalBjmUtara())}}</span>
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
        <span style="font-size:16px; font-weight:bold">{{$data->where('kecamatan','BANJARMASIN SELATAN')->count()}} /{{number_format(totalBjmSelatan())}}</span>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@endif

@endsection
@push('js')

<!-- Select2 -->
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
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
