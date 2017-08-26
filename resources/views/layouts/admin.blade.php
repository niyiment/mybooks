
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invoice Management System</title>
    
    <link href="{{URL::asset('css/bootstrap.min.css')}}"
    rel="stylesheet">
    <link href="{{URL::asset('css/datepicker.css')}}"
    rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{URL::asset('css/app.css') }}">
    <link href="{{URL::asset('css/skin-blue.min.css') }}" rel="stylesheet" >
    <link href="{{URL::asset('css/jQuery-ui.min.css') }}" rel="stylesheet" >
    <link href="{{URL::asset('datatables/jquery.dataTables.min.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{URL::asset('css/pace.min.css') }}">
    <link href="{{URL::asset('daterange/daterangepicker.css') }}" rel="stylesheet" >

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
<script src="{{URL::asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/jQuery-ui.min.js')}}"></script>
<script src="{{URL::asset('datatables/jquery.dataTables.min.js')}}">
</script>
<script src="{{URL::asset('daterange/moment.js')}}">
</script>
<script src="{{URL::asset('daterange/daterangepicker.js')}}">
</script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{URL::asset('images/favicon.png')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{URL::asset('images/favicon.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{ Request::is('authors*') ? 'active' : '' }}">
          <a href="{{ route('authors') }}"><i class="fa fa-user"></i>Authors</a>
        </li>
        <li class="{{ Request::is('books*') ? 'active' : '' }}">
          <a href="{{ route('books') }}"><i class="fa fa-database"></i>Books</a>
        </li>
        <li class="{{ Request::is('customers*') ? 'active' : '' }}">
          <a href="{{ route('customers') }}"><i class="fa fa-briefcase"></i>Customers</a>
        </li>
        <li class="{{ Request::is('borrowers*') ? 'active' : '' }}">
          <a href="{{ route('borrowers') }}"><i class="fa fa-list"></i>Borrower</a>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Settings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
            @else
              <li><a href="{{ route('register') }}">Register</a></li>
              <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            @endif
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('module')
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>@yield('module')</a></li>
        <li class="active">@yield('title')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
        
        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Niyiment Solutions
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="www.niqs.org.ng">NIQS</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
    <!-- JavaScripts -->

<script src="{{URL::asset('js/pace.js')}}"></script>
<script src="{{URL::asset('js/jquery.slimscroll.min.js')}}"></script>
<script src="{{URL::asset('js/fastclick.min.js')}}"></script>
<script src="{{URL::asset('js/app.min.js')}}"></script>
<!--script src="{{URL::asset('tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{URL::asset('tinymce/tinymce.min.js')}}"></script-->

<script src="{{URL::asset('js/backend.js')}}"></script>
<script src="{{URL::asset('js/bootstrap-datepicker.js')}}"></script>
</body>
</html>