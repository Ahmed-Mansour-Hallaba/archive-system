<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ url('/design/adminPanel/dist/img/download.jpg') }}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ auth()->guard('admin')->user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{ url('/design/adminPanel/dist/img/download.jpg') }}" class="img-circle" alt="User Image">

            <p>
              {{ auth()->guard('admin')->user()->name }}
            </p>
           
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="/admin/profile" class="btn btn-default btn-flat">الملف الشخضى</a>
            </div>
            <div class="pull-right">
              <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">تسجيل الخروج</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
