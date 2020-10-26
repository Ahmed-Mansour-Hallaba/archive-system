@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

        @include('admin.layout.message')
        @yield('content')

    </section>
    <!-- /.content -->
  </div>


@include('admin.layout.footer')


@yield('script')

</body>
</html>
