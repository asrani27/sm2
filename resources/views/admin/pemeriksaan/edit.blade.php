@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/pemeriksaan" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/pemeriksaan/edit/{{$data->id}}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomor" value="{{$data->nomor}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Registrasi</label>
                        <div class="col-sm-10">
                            
                            <input type="text" class="form-control" name="registrasi_id" value="{{$data->registrasi->nomor_reg}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->nomor_polisi}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pemilik</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->pemilik}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->alamat}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">merk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->merk}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">tipe</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->tipe}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">tahun</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->tahun}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">nomor rangka</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->nomor_rangka}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">nomor mesin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$data->registrasi->nomor_mesin}}" readonly>
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
                                <option value="LULUS" {{$data->uji_peralatan == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_peralatan == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Penerangan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_penerangan" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS" {{$data->uji_penerangan == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_penerangan == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Sistem Kemudi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_kemudi" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS" {{$data->uji_kemudi == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_kemudi == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Chasis</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_chasis" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS" {{$data->uji_chasis == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_chasis == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Rangka Body</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_rangka" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS" {{$data->uji_rangka == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_rangka == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Rem</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_rem" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS" {{$data->uji_rem == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_rem == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Uji Mesin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="uji_mesin" required>
                                <option value="">-pilih-</option>
                                <option value="LULUS" {{$data->uji_mesin == 'LULUS' ? 'selected':''}}>LULUS</option>
                                <option value="TIDAK LULUS" {{$data->uji_mesin == 'TIDAK LULUS' ? 'selected':''}}>TIDAK LULUS</option>
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
                                    <option value="{{$item->id}}" {{$data->petugas_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Update Data</button>
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