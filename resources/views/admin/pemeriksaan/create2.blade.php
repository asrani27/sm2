@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/pemeriksaan/create" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /> <br />
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
            <form class="form-horizontal" method="post" action="/superadmin/pemeriksaan/create2" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor" value="{{$no_pem}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Registrasi</label>
                        <div class="col-sm-10">
                            
                            <input type="text" class="form-control" name="registrasi_id" value="{{$registrasi->nomor_reg}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->nomor_polisi}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pemilik</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->pemilik}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->alamat}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">merk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->merk}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">tipe</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->tipe}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">tahun</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->tahun}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">nomor rangka</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->nomor_rangka}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">nomor mesin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$registrasi->nomor_mesin}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <strong>UJI KELAYAKAN</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Peralatan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_peralatan" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Penerangan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_penerangan" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Sistem Kemudi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_kemudi" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Chasis</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_chasis" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Rangka Body</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_rangka" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Rem</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_rem" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Mesin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_mesin" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS">LULUS</option>
                                <option value="TIDAK LULUS">TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <strong>PETUGAS</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Petugas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="petugas_id" required>
                                <option value="">-pilih-</option>
                                @foreach ($petugas as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
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