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
      
      @if (Auth::user()->roles == 'admin')

        <li class="menu-header">Administrator</li>
        <li class="{{ (Request::url() === route('user.index')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user-friends"></i> <span>Users</span></a>
        </li>
        <li
          @if (Request::url() === route('product.index') || Request::url() === route('product-category.index'))
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
              @if (Request::url() === route('product.index'))
                class="active"
              @endif
            >
              <a class="nav-link" href="{{ route('product.index') }}">
                <i class="fas fa-list"></i> <span>Product List</span></a>
            </li>

            <li
              @if (Request::url() === route('product-category.index'))
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

      @endif

      <li class="menu-header">LaraToko</li>
        <li class="{{ (Request::url() === route('customer.index')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('customer.index') }}"><i class="fas fa-users"></i> <span>Customers</span></a>
        </li>

        <li class="{{ (Request::url() === route('transaction.index') || Request::url() === route('transaction.create')) ? 'dropdown active' : 'dropdown' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-shopping-cart"></i> <span>Transaction</span>
          </a>
          <ul class="dropdown-menu">

            <li class="{{ Request::url() === route('transaction.create') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('transaction.create') }}">
                <i class="fas fa-cart-plus"></i> <span>Create Transaction</span></a>
            </li>
            
            <li>
              <a class="nav-link" href="#">
                <i class="fas fa-list-alt"></i> <span>Transaction List</span></a>
            </li>

            <li>
              <a class="nav-link" href="#">
                <i class="far fa-chart-bar"></i> <span>Transaction Report</span></a>
            </li>

          </ul>
        </li>
        
      </li>

      </ul>   
    </aside>
</div>