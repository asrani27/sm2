@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/user" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
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
            <form class="form-horizontal" method="post" action="/superadmin/user/edit/{{$data->id}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" value="{{$data->username}}"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Passsword</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Masukkan Password lagi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password2">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Role/Hak Akses</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control" required>
                                <option value="">-pilih-</option>
                                <option value="superadmin" {{$data->roles->first()->name == "superadmin" ? 'selected':''}}>Superadmin</option>

                                <option value="petugas" {{$data->roles->first()->name == "petugas" ? 'selected':''}}>Petugas Pemeriksa Data</option>
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