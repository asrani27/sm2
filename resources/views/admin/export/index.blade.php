@extends('layouts.app')
@push('css')


@endpush
@section('content')
<div class="row">
  
    <div class="col-lg-3">
      <h2>EXPORT</h2>
    </div>
</div>
<hr>
<div class="row">
  <form method="get" action="/superadmin/export/filter">
    @csrf
    <div class="col-lg-3">
      <select class="form-control" name="kecamatan">
        <option value="">-kecamatan-</option>
        @foreach (kecamatan() as $item)
            <option value="{{$item->nama}}" {{request('kecamatan') == $item->nama ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-3">
      <select class="form-control" name="kelurahan">
        <option value="">-kelurahan-</option>
        @foreach (kelurahan() as $item)
            <option value="{{$item->nama}}"  {{request('kelurahan') == $item->nama ? 'selected':''}}>{{$item->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-1">
      <div class="input-group input-group-md">
        <input type="text" name="rt" class="form-control pull-right" placeholder="RT" value="{{request('rt')}}">
      </div>
    </div>
    <div class="col-lg-1">
      <div class="input-group input-group-md">
        <input type="text" name="tps" class="form-control pull-right" placeholder="TPS" value="{{request('tps')}}">

       </div>
    </div>
    <div class="col-lg-1">
      <select class="form-control" name="list">
        <option value="10" {{request('list') == '10' ? 'selected':''}}>10</option>
        <option value="25" {{request('list') == '25' ? 'selected':''}}>25</option>
        <option value="50" {{request('list') == '50' ? 'selected':''}}>50</option>
        <option value="100" {{request('list') == '100' ? 'selected':''}}>100</option>
        
      </select>
    </div>
    <div class="col-lg-2">
      <div class="input-group input-group-md">
        <button tpe="submit" class="btn btn-md btn-primary" name="button" value="filter"><i class="fa fa-search"></i> FILTER</button>
        &nbsp;
        <button tpe="submit" class="btn btn-md btn-primary" name="button" value="csv"><i class="fa fa-file"></i> CSV</button>
       </div>
    </div>
    
  </form>
</div>
<br/>

@endif
@endsection
@push('js')

@endpush
