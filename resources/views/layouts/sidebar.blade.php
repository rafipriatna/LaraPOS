<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">LaraPOS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">LP</a>
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

          <li class="{{ (Request::url() === route('companyProfile.index')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('companyProfile.index') }}"><i class="ion-android-settings"></i> <span>Company Profile</span></a>
          </li>

        </li>
      </li>

      @endif

      <li class="menu-header">LaraPOS</li>
        <li class="{{ (Request::is('transaction/index') || Request::is('transaction/report') || Request::is('transaction/create/*')) ? 'dropdown active' : 'dropdown' }}">
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

            <li class="{{ Request::url() === route('transaction.report') ? 'active' : '' }}">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#transactionModal">
                <i class="ion-clipboard"></i> <span>Transaction Report</span></a>
            </li>

          </ul>
        </li>
        
      </li>

      </ul>   
    </aside>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="transactionModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ route('transaction.report') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Transaction Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Rentang Waktu</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="text" class="form-control daterange-cus" name="date">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
