@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-question"></i> Panduan Cara Input!</h4>
            Masukkan NIK pada kolom di bawah, kemudian klik Check DPT, jika data ditemukan maka detail informasi dan status akan muncul, jika
            status belum terdapat sebagai pendukung silahkan klik tombol "simpan pendukung"
          </div>
        {{-- <a href="/superadmin/koordinator/tps" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br /> --}}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
            <form class="form-horizontal" method="get" action="/superadmin/pendukung/check">    
                @csrf
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nik" minlength="16" maxlength="16" value="{{old('nik')}}" placeholder="NIK Pendukung" onkeypress="return hanyaAngka(event)" required>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-flat btn-primary btn-block"><i class="fa fa-search"></i> Check DPT</button> <br><br>
                </div>
            </form>
    </div>

      @if ($info == true)   
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Detail Informasi</h3>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" method="post" action="/superadmin/pendukung/store">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" value="{{$data == null ? '' : $data->nik}}" readonly="">
                            </div>
                            <label class="col-sm-2 control-label">NAMA</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" value="{{$data == null ? '' : $data->nama}}" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">KECAMATAN</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kecamatan" value="{{$data == null ? '' : $data->kecamatan}}" readonly="">
                            </div>
                            <label class="col-sm-2 control-label">KELURAHAN</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kelurahan" value="{{$data == null ? '' : $data->kelurahan}}" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">RT</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="rt" value="{{$data == null ? '' : $data->rt}}" readonly="">
                            </div>
                            <label class="col-sm-2 control-label">TPS</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tps" value="{{$data == null ? '' : $data->tps}}" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">STATUS</label>
                            <div class="col-sm-4">
                                
                                @if ($status === null)
                                    -
                                @elseif($status === true)
                                    
                                <label class="control-label text-green" for="inputSuccess"><i class="fa fa-check"></i> Sudah Terdaftar</label>
                                @elseif($status === false)
                                <label class="control-label text-red" for="inputSuccess"><i class="fa fa-times"></i> Belum Terdaftar</label>

                                @endif
                            </div>
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> SIMPAN PENDUKUNG</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- /.box-body -->
            </div>
        </div>
      @endif
</div>

@endsection
@push('js')
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush
