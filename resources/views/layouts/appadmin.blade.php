<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title')</title>
  <!-- Bootstrap core CSS-->
  @yield('css')
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  @include('share.admin._header')

  <div class="content-wrapper">
    @yield('content')
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    @include('share.admin._footer')
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @include('share.admin._logout')
    <!-- Bootstrap core JavaScript-->
    @yield('script')
  </div>
</body>

</html>

