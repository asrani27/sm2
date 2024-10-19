@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/registrasi" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /> <br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Tambah Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/registrasi/create" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Registrasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_reg" value="{{$no_reg}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_polisi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Kendaraan</label>
                        <div class="col-sm-10">
                            <select name="jenis_id" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($jenis as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pemilik</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pemilik" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">merk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="merk" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">tipe</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tipe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">tahun</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tahun" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">nomor rangka</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_rangka" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">nomor mesin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor_mesin" required>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right" ><i class="fa fa-save"></i> Simpan Data</button>
                </div>
                <!-- /.box-footer -->
            </form>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')

@endpush