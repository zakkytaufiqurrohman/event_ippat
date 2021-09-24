<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">IPPAT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">IPPAT</a>
        </div>
        <ul class="sidebar-menu">
        <li class="{{ (request()->is('data*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('data')}}"><i class="fas fa-building"></i> <span>Data Peserta</span></a></li>
        <li class="{{ (request()->is('pendaftar*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pendaftar')}}"><i class="fas fa-user-plus"></i> <span>Pendaftar</span></a></li>
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fas fa-ship"></i> <span>Pengda</span></a></li>
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fas fa-th"></i> <span>Laporan</span></a></li>
        <li class="nav-item dropdown  {{ (request()->is('data*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Scan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}"><a class="nav-link" href="">Daftar Ulang</a></li>
                    <li class="{{ (request()->is('kanwil*')) ? 'active' : '' }}"><a class="nav-link" href="">Surat Suara</a></li>
                    <li class="{{ (request()->is('upt*')) ? 'active' : '' }}"><a class="nav-link" href="">Kotak Suara</a></li>
                </ul>
        </li>
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fa fa-tv"></i> <span>Live Record</span></a></li>
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fas fa-user"></i> <span>User</span></a></li>
        </ul>
      
    </aside>
</div>