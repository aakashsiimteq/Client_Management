<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('bower_components/admin-lte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <!-- Status -->
        <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Main Menu</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-address-card"></i> <span>Customer</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{route('customer.create')}}">Add Customer</a>
          </li>
          <li><a href="{{route('customer.index')}}">View Customer</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-cube"></i> <span>Project</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('project.index')}}">View Project</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-credit-card"></i> <span>Invoices</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#">Add Manual Invoices</a></li>
          <li><a href="{{route('invoice.index')}}">View Invoices</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-cogs"></i> <span>Utilities</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"></a></li>
        </ul>
      </li>
      <li class="header">Reports</li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
