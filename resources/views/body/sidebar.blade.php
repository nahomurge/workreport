@php
$prefix = Request::route()->getPrefix(); 
$route = Route::current()->getName();
@endphp
<!-- Admin side bar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">WRMS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="search" aria-label="search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
      <li class="nav-item">
          <a href="{{route('index')}}" class="nav-link {{ ($route == 'index')?'active':''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
             Add Place
            </p>
          </a>
        </li>
      <li class="nav-item">
          <a href="{{route('viewrecord')}}" class="nav-link {{ ($route == 'viewrecord')?'active':''}}">
            <i class="nav-icon fas fa-stopwatch"></i>
            <p>
             Add Workhour
            </p>
          </a>
        </li>
      <li class="nav-item">
          <a href="{{route('report')}}" class="nav-link {{ ($route == 'report')?'active':''}}">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>
             Report
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
