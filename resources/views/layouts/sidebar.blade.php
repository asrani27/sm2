
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
      @if (Auth::user()->username === 'admin') 
      <li class="{{ (request()->is('superadmin/paslon*')) ? 'active' : '' }}"><a href="/superadmin/paslon"><i class="fa fa-users"></i> <span>Data Paslon</span></a></li>
        <li class="{{ (request()->is('superadmin/user*')) ? 'active' : '' }}"><a href="/superadmin/user"><i class="fa fa-users"></i> <span>Data Pengguna Aplikasi</span></a></li>
        <li class="{{ (request()->is('superadmin/saksi*')) ? 'active' : '' }}"><a href="/superadmin/saksi"><i class="fa fa-users"></i> <span>Data Saksi</span></a></li>
       
        <li class="{{ (request()->is('superadmin/terpercaya*')) ? 'active' : '' }}"><a href="/superadmin/terpercaya"><i class="fa fa-users"></i> <span>Data Terpercaya</span></a></li>
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
        <li class="{{ (request()->is('superadmin/validpilkada*')) ? 'active' : '' }}"><a href="/superadmin/validpilkada"><i class="fa fa-users"></i> <span>Data DPT Pilkada Valid</span></a></li>
        <li class="{{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}"><a href="/superadmin/laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
        {{-- <li class="{{ (request()->is('superadmin/export*')) ? 'active' : '' }}"><a href="/superadmin/export"><i class="fa fa-file-excel-o"></i> <span>Export</span></a></li> --}}
        <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      @else

      @if (Auth::user()->username === 'irul') 
      <li class="{{ (request()->is('superadmin/user*')) ? 'active' : '' }}"><a href="/superadmin/user"><i class="fa fa-users"></i> <span>Data Pengguna Aplikasi</span></a></li>
      @else
      @endif
      <li class="{{ (request()->is('superadmin/pengumpul*')) ? 'active' : '' }}"><a href="/superadmin/pengumpul"><i class="fa fa-users"></i> <span>Petugas Pengumpul Data</span></a></li>
        <li class="{{ (request()->is('superadmin/pilkada*')) ? 'active' : '' }}"><a href="/superadmin/pilkada"><i class="fa fa-users"></i> <span>Data DPT Pilkada</span></a></li>
        
        <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      @endif
    @elseif(Auth::user()->hasRole('petugas'))
    <li class="{{ (request()->is('petugas')) ? 'active' : '' }}"><a href="/petugas"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    <li class="{{ (request()->is('superadmin/pengumpul*')) ? 'active' : '' }}"><a href="/superadmin/pengumpul"><i class="fa fa-users"></i> <span>Petugas Pengumpul Data</span></a></li>
    <li class="{{ (request()->is('superadmin/pilkada*')) ? 'active' : '' }}"><a href="/superadmin/pilkada"><i class="fa fa-users"></i> <span>Data DPT Pilkada</span></a></li>
    {{-- <li class="{{ (request()->is('petugas/pilkada*')) ? 'active' : '' }}"><a href="/petugas/pilkada"><i class="fa fa-users"></i> <span>Data DPT Pilkada</span></a></li> --}}
    <li class="{{ (request()->is('petugas/laporan*')) ? 'active' : '' }}"><a href="/petugas/laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

    @elseif(Auth::user()->hasRole('saksi'))
    <li class="{{ (request()->is('saksi')) ? 'active' : '' }}"><a href="/saksi"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    <li class="{{ (request()->is('user')) ? 'active' : '' }}"><a href="/user"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    {{-- <li class="{{ (request()->is('user/sm*')) ? 'active' : '' }}"><a href="/user/sm"><i class="fa fa-users"></i> <span>Data SM</span></a></li> --}}
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @endif
    </ul>
    
</section>