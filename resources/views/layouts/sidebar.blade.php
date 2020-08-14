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
        <li class="{{ (Request::url() === url('/')
            || Request::url() === url('/admin')) ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link"><i class="ion-android-home"></i> <span>Dashboard</span></a>
      </li>
      
      @if (Auth::user()->roles == 'admin')

        <li class="menu-header">Administrator</li>
        <li class="{{ (Request::url() === route('user.index')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('user.index') }}"><i class="ion-android-person"></i> <span>Users</span></a>
        </li>
        <li class="{{ (Request::url() === route('product.index')
            || Request::url() === route('product-category.index')) ? 'dropdown active' : 'dropdown' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="ion-cube"></i> <span>Products</span>
          </a>
          <ul class="dropdown-menu">

            <li class="{{ (Request::url() === route('product.index')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('product.index') }}">
                <i class="ion-android-list"></i> <span>Product List</span></a>
            </li>

            <li class="{{ (Request::url() === route('product-category.index')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('product-category.index') }}">
                <i class="ion-pricetags"></i> <span>Product Categories</span>
              </a>
            </li>

          </ul>

          <li class="{{ (Request::url() === route('customer.index')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('customer.index') }}"><i class="ion-person-stalker"></i> <span>Customers</span></a>
          </li>

          <li class="{{ (Request::url() === route('coupon.index')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('coupon.index') }}"><i class="ion-cash"></i> <span>Coupons</span></a>
          </li>

          <li class="{{ (Request::url() === route('about.index')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('about.index') }}"><i class="ion-android-settings"></i> <span>About Company</span></a>
          </li>

        </li>
      </li>

      @endif

      <li class="menu-header">LaraToko</li>
        <li class="{{ (Request::url() === route('transaction.index') || Request::is('transaction/create/*')) ? 'dropdown active' : 'dropdown' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="ion-ios-cart"></i> <span>Transaction</span>
          </a>
          <ul class="dropdown-menu">

            <li class="{{ Request::is('transaction/create/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('transaction.create', AppHelper::transaction_code()) }}">
                <i class="ion-bag"></i> <span>Create Transaction</span></a>
            </li>
            
            <li class="{{ Request::url() === route('transaction.index') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('transaction.index') }}">
                <i class="ion-ios-list"></i> <span>Transaction List</span></a>
            </li>

            <li>
              <a class="nav-link" href="#">
                <i class="ion-clipboard"></i> <span>Transaction Report</span></a>
            </li>

          </ul>
        </li>
        
      </li>

      </ul>   
    </aside>
</div>