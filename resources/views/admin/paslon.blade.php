<div class="row">
    @foreach (paslon() as $item)
        
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white text-right" style="background: url('/storage/paslon/{{$item->filename}}') center center; background-size:100% 100%; height:260px;border-radius:.25rem; padding:0px;box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -webkit-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset; -moz-box-shadow: -1px -53px 89px 2px rgba(0,0,0,0.8) inset;">    
        </div>
        
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-12 border-right">
              <div class="description-block">
                <h1 class="description-headr">{{totalSuara($item->nomor)}}</h1>
                <span class="description-text">Suara</span>
              </div>
              <!-- /.description-block -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
    @endforeach
    <!-- /.col -->
  </div>