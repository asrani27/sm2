@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
      <a href="/superadmin/wa" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-arrow-left"></i> Kembali </a><br/><br/>
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Detail Status Pengiriman WA</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Status</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->telp}}</td>
                <td>{{$item->status == null ? 'progress' : $item->status}}</td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
