
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Beranda</span></a></li>

    <li class="{{ (request()->is('superadmin/pengumpul*')) ? 'active' : '' }}"><a href="/superadmin/pengumpul"><i class="fa fa-users"></i> <span>Petugas Pengumpul Data</span></a></li>
    <li class="treeview {{ (request()->is('superadmin/koordinator*')) ? 'active' : '' }}">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Koordinator</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
          <li class="{{ (request()->is('superadmin/koordinator/kecamatan*')) ? 'active' : '' }}"><a href="/superadmin/koordinator/kecamatan"><i class="fa fa-circle-o"></i> Kecamatan</a></li>
          <li class="{{ (request()->is('superadmin/koordinator/kelurahan*')) ? 'active' : '' }}"><a href="/superadmin/koordinator/kelurahan"><i class="fa fa-circle-o"></i> Kelurahan</a></li>
          <li class="{{ (request()->is('superadmin/koordinator/tps*')) ? 'active' : '' }}"><a href="/superadmin/koordinator/tps"><i class="fa fa-circle-o"></i> TPS</a></li>
      </ul>
    </li>
   <li class="{{ (request()->is('superadmin/dpt*')) ? 'active' : '' }}"><a href="/superadmin/dpt"><i class="fa fa-users"></i> <span>Data DPT Pileg</span></a></li>
   <li class="{{ (request()->is('superadmin/pilkada*')) ? 'active' : '' }}"><a href="/superadmin/pilkada"><i class="fa fa-users"></i> <span>Data DPT Pilkada</span></a></li>
   <li class="{{ (request()->is('superadmin/pendukung*')) ? 'active' : '' }}"><a href="/superadmin/pendukung"><i class="fa fa-edit"></i> <span>Input Pendukung</span></a></li>
     {{-- <li class="{{ (request()->is('superadmin/pendaftar*')) ? 'active' : '' }}"><a href="/superadmin/pendaftar"><i class="fa fa-users"></i> <span>Data Sahabat</span></a></li>
    <li class="treeview {{ (request()->is('superadmin/timses*')) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Timses Grup</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ (request()->is('superadmin/timses/grup*')) ? 'active' : '' }}"><a href="/superadmin/timses/grup"><i class="fa fa-circle-o"></i> Grup</a></li>
        </ul>
    </li>
    <li class="treeview {{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ (request()->is('superadmin/laporan/rt*')) ? 'active' : '' }}"><i class="fa fa-circle-o"></i> RT</a></li>
          <li><a href="{{ (request()->is('superadmin/laporan/kelurahan*')) ? 'active' : '' }}"><i class="fa fa-circle-o"></i> Kelurahan</a></li>
          <li><a href="{{ (request()->is('superadmin/laporan/kecamatan*')) ? 'active' : '' }}"><i class="fa fa-circle-o"></i> Kecamatan</a></li>
          <li><a href="{{ (request()->is('superadmin/laporan/kota*')) ? 'active' : '' }}"><i class="fa fa-circle-o"></i> Kota Banjarmasin</a></li>
        </ul>
      </li>
      <li class="treeview {{ (request()->is('superadmin/struktur*')) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-building-o"></i>
          <span>Struktur Organisasi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ (request()->is('superadmin/struktur/kota*')) ? 'active' : '' }}"><i class="fa fa-circle-o"></i> Kota</a></li>
            <li><a href="{{ (request()->is('superadmin/struktur/kelurahan*')) ? 'active' : '' }}"><i class="fa fa-circle-o"></i> Kelurahan</a></li>
        </ul>
    </li> --}}
    <li class="{{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}"><a href="/superadmin/laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    <li class="{{ (request()->is('user')) ? 'active' : '' }}"><a href="/user"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    {{-- <li class="{{ (request()->is('user/sm*')) ? 'active' : '' }}"><a href="/user/sm"><i class="fa fa-users"></i> <span>Data SM</span></a></li> --}}
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @endif
    </ul>
    
</section>