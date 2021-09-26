<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">IPPAT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">IPPAT</a>
        </div>
        <ul class="sidebar-menu">
        
        @if(\Auth::user()->level == 1)
        <li class="{{ (request()->is('data*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('data')}}"><i class="fas fa-building"></i> <span>Data Peserta</span></a></li>
        <li class="{{ (request()->is('pendaftar*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pendaftar')}}"><i class="fas fa-user-plus"></i> <span>Pendaftar</span></a></li>
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fas fa-ship"></i> <span>Pengda</span></a></li>
        <li class="{{ (request()->is('admin*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('admin')}}"><i class="fas fa-user"></i> <span>User</span></a></li>
        @endif
        @if(\Auth::user()->level == 1 || \Auth::user()->level == 2)
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fas fa-th"></i> <span>Laporan</span></a></li>
        @endif
        <li class="nav-item dropdown  {{ (request()->is('scan*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Scan</span></a>
                <ul class="dropdown-menu">
                    @if(\Auth::user()->level == 1 || \Auth::user()->level == 3 ||  \Auth::user()->level == 2 )
                    <li class="{{ (request()->is('*daftar_ulang*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('scan.daftar_ulang')}}">Daftar Ulang</a></li>
                    @endif
                    @if(\Auth::user()->level == 1 || \Auth::user()->level == 4 ||  \Auth::user()->level == 2 )                    
                    <li class="{{ (request()->is('*surat_suara*')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('scan.surat_suara')}}">Surat Suara</a></li>
                    @endif
                    @if(\Auth::user()->level == 1 || \Auth::user()->level == 5 ||  \Auth::user()->level == 2 )                    
                    <li class="{{ (request()->is('*voting*')) ? 'active' : '' }}"><a class="nav-link" href="">Kotak Suara</a></li>
                    @endif
                </ul>
        </li>
        <li class="{{ (request()->is('pengda*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pengda')}}"><i class="fa fa-tv"></i> <span>Live Record</span></a></li>
        </ul>
      
    </aside>
</div>