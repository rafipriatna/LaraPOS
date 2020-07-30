<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li
          @if (Request::url() === url('home'))
            class="active"
          @endif
        >
          <a href="{{ url('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Administrator</li>
        <li
          @if (Request::url() === url('products'))
            class="active"
          @endif
        >
          <a class="nav-link" href="{{ url('products') }}"><i class="fas fa-box"></i> <span>Products List</span></a></li>
      </ul>   
    </aside>
</div>