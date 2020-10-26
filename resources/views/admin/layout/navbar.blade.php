<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>الأرشيف الإلكتروني</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      @if (direction() == 'ltr')
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      @endif

      {{--  include menu file here  --}}

      @include('admin.layout.menu')

      {{--  end of menu file  --}}
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center">
          <img src="{{ url('/design/adminPanel/dist/img/download.jpg') }}" class="img-circle" alt="User Image"><br>
        </div>
        {{--  <div class="pull-right info">
            <p></p>
          <p>{{ auth()->guard('admin')->user()->name }}</p>
          <p>mans</p>

        </div>  --}}
      </div>
      <div class="devider"></div><br><br>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        {{--  main menu  --}}

        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span>الرئيسية</span>
              <span class="pull-left-container">
                <i class="fa fa-angle-right pull-left"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ aurl('') }}"><i class="fa fa-home"></i>الرئيسية</a></li>
          </ul>
        </li>
        <br>

         @if (auth()->guard('admin')->user()->user_type == 0 && auth()->guard('admin')->user()->id == 1 &&
         auth()->guard('admin')->user()->level == 0  && auth()->guard('admin')->user()->user_id == null)

           <li class="treeview {{ active_menu('admin')[0] }}">
          <a href="#">
            <i class="fa fa-user"></i> <span>{{ trans('admin.admin')  }}<strong>&nbsp;{{ trans('admin.control') }}</strong></span>
              <span class="pull-left-container">
                <i class="fa fa-angle-right pull-left"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('admin')[1] }} ">
               <li class="active"><a href="{{ aurl('admin') }}"><i class="fa fa-home"></i>حساب المشرف</a></li>
          </ul>
        </li>
        <br>

        @endif



        {{--  route for documents  --}}
         @if (auth()->guard('admin')->user()->user_type !== 0 && auth()->guard('admin')->user()->id !== 1 &&
         auth()->guard('admin')->user()->level !== 0  && auth()->guard('admin')->user()->user_id !== null)

            <li class="treeview {{ active_menu('documents')[0] }}">
            <a href="#">
                <i class="fa fa-book"></i> <span>{{ trans('admin.documents')  }}</span>
                @if (direction() == 'ltr')
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                @else
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
                @endif
            </a>


            <ul class="treeview-menu" style="{{ active_menu('documents')[1] }} ">

                <li class="active"><a href="{{ aurl('documents') }}"><i class="fa fa-book"></i>{{ trans('admin.documents') }}</a></li><br>
                <li class="active"><a href="{{ aurl('documents/replysoon') }}"><i class="fa fa-book"></i>{{ trans('admin.replysoon') }}</a></li><br>
                <li class="active"><a href="{{ aurl('documents/replyend') }}"><i class="fa fa-book"></i>{{ trans('admin.replyend') }}</a></li><br>

                @if (auth()->guard('admin')->user()->user_type == 0)
                    <li class="active"><a href="{{ aurl('documents/branches') }}"><i class="fa fa-book"></i> الأفرع و الاقسام الخاصة بالترسانة </a></li><br>
                @endif

                @if (auth()->guard('admin')->user()->user_type == 0 )
                    <li class="active"><a href="{{ aurl('documents/departments') }}"><i class="fa fa-book"></i>المباني الخاصة بالترسانة </a></li><br>
                @endif

                @if (auth()->guard('admin')->user()->user_type == 1 )
                    <li class="active"><a href="{{ aurl('documents/branches/departments') }}"><i class="fa fa-book"></i>المباني الخاصة بالفرع </a></li><br>

                @endif

                <li class="active"><a href="{{ aurl('documents/exports') }}"><i class="fa fa-book"></i>بحث المكاتبات الصادرة</a></li><br>
                <li class="active"><a href="{{ aurl('documents/imports') }}"><i class="fa fa-book"></i>بحث المكاتبات الواردة</a></li><br>
                <li class="active"><a href="{{ aurl('documents/create') }}"><i class="fa fa-plus"></i>{{ trans('admin.document_create') }}</a></li>
            </ul>
            </li>
              <li class="treeview ">
                  <a href="#">
                      <i class="fa fa-folder"></i> <span>المتابعة</span>
                      @if (direction() == 'ltr')
                          <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                      @else
                          <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
                      @endif
                  </a>
                  <ul class="treeview-menu">
                      <li class="active"><a href="/folders"><i class="fa  fa-folder"></i>المتابعة</a></li><br>
                      <li class="active"><a href="/createFolder"><i class="fa fa-plus"></i>اضافة متابعة</a></li>
                  </ul>
              </li>
              <li ><a href="/units"><i class="fa  fa-building"></i>الوحدات</a></li><br>





         @endif
      </ul>
    </section>
  </aside>
