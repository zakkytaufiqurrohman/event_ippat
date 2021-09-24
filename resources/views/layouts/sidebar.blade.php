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


        </ul>
      
    </aside>
</div>