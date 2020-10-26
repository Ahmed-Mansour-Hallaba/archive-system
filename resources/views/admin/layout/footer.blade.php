<!-- ./wrapper -->
<script src="{{ url('/design/adminPanel/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('/design/adminPanel/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ url('/design/adminPanel/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/design/adminPanel/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('/design/adminPanel/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/vendor\datatables\buttons.server-side.js') }}"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('/design/adminPanel/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ url('/design/adminPanel/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ url('/design/adminPanel/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('/design/adminPanel/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url('/design/adminPanel/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('/design/adminPanel/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('/design/adminPanel/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('/design/adminPanel/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ url('/design/adminPanel/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('/design/adminPanel/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('/design/adminPanel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('/design/adminPanel/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('/design/adminPanel/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/design/adminPanel/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@stack('js')
@stack('css')

