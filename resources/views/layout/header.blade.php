<!-- Main Header -->
<header class="main-header" style="border-color: black">

  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini" ><b>C</b>MS</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img width="100" height="50" style="margin-bottom:10px;" src="{{ asset ("img/logo.png")}}">CMS</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="border-color: black">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="border-left : none">
            <!-- The user image in the navbar-->
            <img src="{{ asset ("bower_components/admin-lte/dist/img/user2-160x160.jpg")}}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header" style="background-color: black;">
              <img src="{{ asset("bower_components/admin-lte/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">

              <p>
                {{ Auth::user()->name }}
                <small>Member since {{ Carbon\Carbon::parse( Auth::user()->created_at)->format('M. Y') }}</small>

              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">

              <div class="pull-right">
                <a href="href="{{ route('logout') }}"" class="btn btn-primary login-btn btn-flat" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i> Sign out
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
