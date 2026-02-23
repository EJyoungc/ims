<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('dist/img/IMS logo 128 x128.png') }}" alt="AdminLTE Logo" class="img-fluid col-6 text-center "
            > <br>
        <span class=" text-wrap  "><small>Inventory Management System</small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/images/svgs/icon-user-male.svg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile') }}" class="d-block">{{ empty(Auth::user()->name) ? ''  : Auth::user()->name  }}
                <span class="badge bg-purple" >{{ empty(Auth::user()->role) ? '' : Auth::user()->role  }}</span>  </a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a wire:navigate.hover href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }} ">
                        <i class="nav-icon ti ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                 @if(in_array(Auth::user()->role, ['seller']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ti ti-box"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a wire:navigate.hover href="{{ route('products') }}" class="nav-link {{ Route::is('products') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate.hover href="{{ route('categories') }}" class="nav-link {{ Route::is('categories') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('suppliers') }}" class="nav-link {{ Route::is('suppliers') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suppliers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases') }}" class="nav-link {{ Route::is('purchases') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchases</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(in_array(Auth::user()->role, ['owner', 'system']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ti ti-box"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products') }}" class="nav-link {{ Route::is('products') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories') }}" class="nav-link {{ Route::is('categories') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('suppliers') }}" class="nav-link {{ Route::is('suppliers') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suppliers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases') }}" class="nav-link {{ Route::is('purchases') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchases</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(in_array(Auth::user()->role, ['seller', 'owner', 'system']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ti ti-shopping-cart"></i>
                        <p>
                            Sales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sales') }}" class="nav-link {{ Route::is('sales') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('returns') }}" class="nav-link {{ Route::is('returns') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Returns</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers') }}" class="nav-link {{ Route::is('customers') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pos') }}" class="nav-link {{ Route::is('pos') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>POS</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @endif



                @if(in_array(Auth::user()->role, ['owner', 'system']))
                <li class="nav-item">
                    <a href="{{ route('expenses') }}" class="nav-link {{ Route::is('expenses') ? 'active' : '' }} ">
                        <i class="nav-icon ti ti-credit-card"></i>
                        <p>Expenses</p>
                    </a>
                </li>
                @endif

                @if(in_array(Auth::user()->role, ['owner', 'system']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ti ti-chart-line"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.sales') }}" class="nav-link {{ Route::is('reports.sales') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.profit') }}" class="nav-link {{ Route::is('reports.profit') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profit Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.stock') }}" class="nav-link {{ Route::is('reports.stock') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(in_array(Auth::user()->role, ['system', 'owner']))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon ti ti-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link {{ Route::is('users') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('audit-logs') }}" class="nav-link {{ Route::is('audit-logs') ? 'active' : '' }} ">
                        <i class="nav-icon ti ti-list"></i>
                        <p>
                            Audit Logs
                        </p>
                    </a>
                </li>
                @endif

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" id="logout">
                    @csrf
                </form>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout').submit();" class="nav-link">
                    <i class="nav-icon ti ti-logout text-danger "></i>
                    <p class="text-danger">
                        Logout
                    </p>
                </a>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
