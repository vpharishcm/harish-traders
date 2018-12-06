
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('home')}}" class="brand-link">
        <img src="/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Harish Traders</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/img/boy.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            @if(Auth::check())
              <a href="#" class="d-block">{{ Auth::user()->name}}</a>
            @else
              <script type="text/javascript">
                window.location = "{{ url('/login') }}";//here double curly bracket
              </script>
            @endif
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="material-icons ">person</i>
                <p>
                  Suppliers
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  
                  <a href={{route('supplier.index')}} class="nav-link">
                    <i class="material-icons">remove_red_eye</i>
                    <p>Show Supplier</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href={{route('supplier.create')}} class="nav-link">
                    <i class="material-icons">person_add</i>
                    <p>Add Supplier</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                  Products
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href={{route('product.index')}} class="nav-link">
                    <i class="fas fa-eye"></i>
                    <p>Show Products</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href={{route('product.create')}} class="nav-link">
                    <i class="fas fa-plus"></i>
                    <p>Add Product</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                
                <p>
                  Expences
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href={{route('expence.index')}} class="nav-link">
                    
                    <p>Show Expences</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href={{route('expence.create')}} class="nav-link">

                    <p>Add Expence</p>
                  </a>
                </li>
              </ul>
              
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-file"></i>
                <p>
                  Bills
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href={{route('bill.index')}} class="nav-link">
                    <i class="fas fa-eye"></i>
                    <p>Show Bills</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href={{route('bill.create')}} class="nav-link">
                    <i class="fas fa-file-medical"></i>
                    <p>Add bills</p>
                  </a>
                </li>
              </ul>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                    <p>
                        {{ Auth::user()->name }} <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                    <a href={{route('logout')}} class="nav-link" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">>
                        <i class="fa fa-circle-o nav-icon"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li> 
                </ul>
            </li>
        @endguest
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Simple Link
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li> --}}
          </ul>
          
                   
        </nav>  
      </div>
    <!-- /.sidebar -->
  </aside>