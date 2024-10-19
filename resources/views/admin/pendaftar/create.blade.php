@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Tambah Sahabat</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/pendaftar/create">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dibawai Oleh</label>
                        <div class="col-sm-10">
                            <select name="pendaftar_id" class="form-control">
                                <option value="">-</option>
                            @foreach ($oleh as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <select name="kelurahan_id" class="form-control" required>
                                <option value="">-</option>
                            @foreach ($kelurahan as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik" minlength="16" maxlength="16" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="rt"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Anggota Grup?</label>
                        <div class="col-sm-10">
                            <select name="grup_id" class="form-control">
                                <option value="">-</option>
                            @foreach ($grup as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                            jika bukan anggota grup, kosongkan 
                        </div>
                    </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn pull-right"><i class="fa fa-save"></i> Simpan</button>
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