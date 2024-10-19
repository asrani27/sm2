<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SM 2024</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- IziToast -->
<link rel="stylesheet" href="/notif/dist/css/iziToast.min.css">
<script src="/notif/dist/js/iziToast.min.js" type="text/javascript"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" style="background-color: #ffc9af">
<div class="wrapper">
    
  <!-- Full Width Column -->
  <div class="content-wrapper" style="background-color: #ffc9af">
    <div class="container">
        
      <!-- Main content -->
      <section class="content">
        
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Gabung Menjadi Sahabat Mukhyar</h3>
          </div>
          <div class="box-body">
           Tanda <span class="text-red">*</span> Wajib di isi! Silahkan isi form di bawah ini <br/> <br/> Sudah menjadi sahabat Mukhyar?,<br/> <a href="/masuk" class="btn btn-xs btn-danger"><b><u>Masuk Disini! <i class="fa fa-sign-in"></i> </u></b> </a>
          </div>
          <!-- /.box-body -->
        </div>

        <form role="form" method="post" action="/gabung">
            @csrf
        <div class="box">
          <div class="box-body">
                <div class="form-group">
                    <label>Nama <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="nama" value="{{old('nama')}}" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label>NIK <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="nik" value="{{old('nik')}}" placeholder="NIK Anda" minlength="16" maxlength="16" onkeypress="return hanyaAngka(event)" required/>
                </div>
                <div class="form-group">
                    <label>Kelurahan <span class="text-red">*</span></label>
                    <select class="form-control select2" style="width: 100%;" name="kelurahan_id" required>
                      <option value="">-pilih-</option>
                      @foreach ($kelurahan as $item)
                          <option value="{{$item->id}}" {{old('kelurahan_id') == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>RT <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="rt" value="{{old('rt')}}" placeholder="RT Anda" onkeypress="return hanyaAngka(event)" required/>
                </div>
                <div class="form-group">
                    <label>Telp/WA <span class="text-red"></span></label>
                <input type="text" class="form-control" name="rt" value="{{old('telp')}}" placeholder="Telp/WA Anda" onkeypress="return hanyaAngka(event)" required/>
                </div>
           </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Gabung</button>

        </form>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
<!-- jQuery 3 -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>

<script>
    @include('layouts.notif')
    </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
</body>
</html>
