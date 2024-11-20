@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
<style>
  #map { height: 500px; }
</style>
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">List TPS {{Auth::user()->name}}</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/kelurahan/tps/suara">
                @csrf
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                            <th>No</th>
                            <th>Nomor TPS</th>
                            <th>Suara Paslon 1</th>
                            <th>Suara Paslon 2</th>
                            <th>Suara Paslon 3</th>
                            <th>Nama Saksi & Telp</th>
                            </tr>
                            @foreach ($data as $key => $item)
                            @if ($item->nomor_1 === 0 && $item->nomor_2 === 0 && $item->nomor_3 === 0)
                                
                            <tr style="font-size: 18px">
                            @else
                                
                            <tr style="background-color: rgb(156, 243, 188);font-size: 18px">
                            @endif
                            <td>
                                {{-- {{1 + $key}} --}}

                                <a href="/kelurahan/edit/{{$item->id}}" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>{{$item->tps}}</td>
                            <td>{{$item->nomor_1}}</td>
                            <td>{{$item->nomor_2}}</td>
                            <td>{{$item->nomor_3}}</td>
                            <td>
                                {{$item->saksi}} <br/>
                                {{$item->telp}} 
                            </td>
                            </tr>
                            @endforeach
                            <tr style="background-color: rgb(251, 213, 185); font-weight:bold;font-size:20px">
                            <td></td>
                            <td>TOTAL</td>
                            <td>{{$data->sum('nomor_1')}}</td>
                            <td>{{$data->sum('nomor_2')}}</td>
                            <td>{{$data->sum('nomor_3')}}</td>
                            <td></td>
                            </tr>
                        </tbody>
                    </table>                  
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    
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
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush