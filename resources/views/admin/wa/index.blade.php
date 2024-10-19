@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>Unlimited</h3>

        <p>STATUS</p>
      </div>
      <div class="icon">
        <i class="fa fa-gear"></i>
      </div>
      <br/>
      {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>Unlimited/Day</h3>

        <p>MAX SEND MESSAGES</p>
      </div>
      <div class="icon">
        <i class="fa fa-comments"></i>
      </div>
      <br/>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{$kontak}}</h3>

        <p>JUMLAH KONTAK</p>
      </div>
      <div class="icon">
        <i class="fa fa-phone"></i>
      </div>
      <br/>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>Expired Date</h3>

        <p>25 Februari 2024</p>
      </div>
      <div class="icon">
        <i class="fa fa-file"></i>
      </div>
      <br/>
    </div>
  </div>
  <!-- ./col -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Send Message</h3>

            <div class="box-tools">
              <a href="/superadmin/wa/add" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-plus"></i> Tambah </a>
              <a href="/superadmin/wa/create" class="btn btn-flat btn-sm btn-primary"  data-toggle="modal" data-target="#modal-default"><i class="fa fa-`"></i> Send Message</a>
              <a href="http://103.178.83.200:8000/scan" target="_blank" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-qrcode"></i> SCAN DEVICE</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>File</th>
                <th>Message</th>
                {{-- <th>Status</th> --}}
                <th>Kirim Ke</th>
                
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td><a href="/storage/video/{{$item->file}}" target="_blank">{{$item->file}}</a></td>
                <td>{!!$item->isi!!}</td>

                <td>
                  @if($item->status == false)
                      sedang mengirim..
                      <a href="/superadmin/wa/stop/{{$item->id}}" class="btn btn-flat btn-sm btn-danger"> Stop</a>
                  @else
                      Selesai
                  @endif
                </td>
                <td>
                  {{$item->kirim_ke}}
                </td>
                <td>
                    <a href="/superadmin/wa/status/{{$item->id}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-whatsapp"></i> Detail Status</a>
                  <a href="/superadmin/wa/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/wa/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-primary" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{-- {{$data->links()}} --}}
        <!-- /.box -->
      </div>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send Message</h4>
      </div>
      <form action="/superadmin/wa/send-message" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="isi" name="message" required><br/>
        <input type="file" class="form-control" name="file">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@push('js')

@endpush
