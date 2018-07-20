<aside class="main-sidebar" style="background-color: black; border-color: black;">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="margin-top: 30px;">
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
        <a href="#"><i class="fa fa-money"></i> <span>Invoices</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('invoice.index')}}">View Invoices</a></li>
          <li><a href="{{route('custom-invoice.index')}}">View Custom Invoices</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-bank"></i> <span>Accounts</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('payment-receive.index')}}">Payment Receive</a></li>
          <li><a href="#">Payment Payables</a></li>
          <li><a href="#">Expense</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-book"></i> <span>Reports</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#">Receivable Report</a></li>
          <li><a href="#">Payable Report</a></li>
          <li><a href="#">GST Report</a></li>
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
