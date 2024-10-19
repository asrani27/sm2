@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/wa" class="btn btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a> <br /> <br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Tambah Data WA Blast</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/wa/create" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="file" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            Format Whatsapp :<br/>
                            :th = emoji
                            \n = spasi<br/>
                            ~teks~ = coret<br/>
                            *teks* = tebal<br/>
                            _teks_ = miring
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Caption</label>
                        <div class="col-sm-10">
                            <textarea name="isi" rows="7" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kirim Ke</label>
                        <div class="col-sm-10">
                            <select name="kirim_ke" class="form-control">
                                <option value="">-pilih-</option>
                                <option value="MASYARAKAT">MASYARAKAT</option>
                                <option value="ASN">ASN</option>
                                <option value="NON ASN">NON ASN</option>
                                <option value="BJM UTARA">BJM UTARA</option>
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

<!-- CK Editor -->
<script src="/assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
@endpush