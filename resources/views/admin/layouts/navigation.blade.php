 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
     <!--  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">ADMIN | <small>Panel</small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="{{ url('admin') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">MASTER</li>
         
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                 Master Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/sellers') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sellers</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/categories') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/sub-categories') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sub Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/brands') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Brands</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/products') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Products</p>
                  </a>
                </li>
            </ul>
          </li>
          
         
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                 Member Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/members') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Members</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/orders/pending') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending Orders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/orders') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Complete Orders</p>
                  </a>
                </li>
            </ul>
          </li>


          <li class="nav-header">REPORTS</li>
         
         
           {{--  <li class="nav-item">
              <a href="{{ url('admin/member-report')}}" class="nav-link">
                <i class="nav-icon far fa-file-alt"></i>
                <p>
                  Member Reports
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/investment-report')}}" class="nav-link">
                <i class="nav-icon far fa-file-alt"></i>
                <p>
                  Investment Reports
                </p>
              </a>
            </li> --}}
           
          <li class="nav-header">ADMIN MANAGEMENT</li>
         
         
          <li class="nav-item">
            <a href="{{ url('admin/users')}}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                User
              </p>
            </a>
          </li>

          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link bg-default">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p class="text">Signout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
