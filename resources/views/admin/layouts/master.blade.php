<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TRN | Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{asset('images/fav.png')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- Theme style -->
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
  <!-- Alertify-->
  <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}">

  <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/selectize/css/selectize.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script type="text/javascript">
    var base_url= "{{ url('/') }}";
  </script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.navigation')
 
  <!-- Content Wrapper. Contains page content -->

  @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Smart X</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>

<!-- jquery-validation -->
<script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-validation/custom-validations.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<script src="{{ asset('js/alertify.min.js') }}"></script>
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/selectize/js/standalone/selectize.js') }}"></script>
    
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="{{ asset('backend/build.js') }}"></script>


{{-- <script type="text/javascript">
    jQuery(document).ready(function($){
        var url = window.location.href;

        $('li a[href="'+url+'"]').parent().addClass('active');
        $('.nav-treeview a[href="'+url+'"]').parent().addClass('active');
        $('.nav-treeview a[href="'+url+'"]').parent().parent().parent().addClass('active');
    });
</script> --}}

<script>
 /** add active class and stay opened when selected */
    var url = window.location;
    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
       return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
       return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>

@if (session('success') || session()->has('message'))
    <script type="text/javascript">
      alertify.success('{{ session('success') }}');
    </script>
@elseif(session('error'))
    <script type="text/javascript">
      alertify.error('{{ session('error') }}');
    </script>
@endif

</body>
</html>
