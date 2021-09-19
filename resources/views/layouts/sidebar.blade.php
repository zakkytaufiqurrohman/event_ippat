<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Kompetensi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Badiklat</a>
        </div>
        <ul class="sidebar-menu">
       
            <li class="{{ (request()->is('home*')) ? 'active' : '' }}"><a class="nav-link" href="{{route('home')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      
    </aside>
</div>