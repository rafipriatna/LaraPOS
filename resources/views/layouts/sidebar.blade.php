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
          @if (Request::url() === url('/') || Request::url() === url('/admin'))
            class="active"
          @endif
        >
          <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">
          <li
            @if (Request::url() === url('/admin/product') || Request::url() === url('/admin/product-category'))
                class="dropdown active"
            @else
                class="dropdown"
            @endif
          >
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
              <i class="fas fa-box"></i> <span>Products</span>
            </a>
            <ul class="dropdown-menu">

              <li
                @if (Request::url() === url('/admin/product'))
                  class="active"
                @endif
              >
                <a class="nav-link" href="{{ route('product.index') }}">
                  <i class="fas fa-list"></i> <span>Product List</span></a>
              </li>

              <li
                @if (Request::url() === url('/admin/product-category'))
                  class="active"
                @endif
              >
                <a class="nav-link" href="{{ route('product-category.index') }}">
                  <i class="fas fa-tags"></i> <span>Product Categories</span>
                </a>
              </li>

            </ul>
          </li>
        </li>
        </ul>   
    </aside>
</div>