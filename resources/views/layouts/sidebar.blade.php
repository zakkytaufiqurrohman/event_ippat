<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">IPPAT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">IPPAT</a>
        </div>
        <ul class="sidebar-menu">
        <li class="{{ (request()->is('data*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('data')}}"><i class="fas fa-building"></i> <span>Data Peserta</span></a></li>
        <li class="{{ (request()->is('pendaftar*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('pendaftar')}}"><i class="fas fa-user-plus"></i> <span>Pendaftar</span></a></li>

        </ul>
      
    </aside>
</div>