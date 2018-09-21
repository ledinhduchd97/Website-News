@extends('layouts.appadmin')
@section('title','Dashboard')
@section('css')
	<!-- Bootstrap core CSS-->
  <link href="{{asset('fe-admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('fe-admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{asset('fe-admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('fe-admin/css/sb-admin.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
@endsection
@section('content')
	<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-book-open"></i>
              </div>
              <div class="mr-5">{{$theloai}} Thể Loại</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('theloai.index')}}">
              <span class="float-left">Chi tiết</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">{{$loaitin}} Loại Tin</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('loaitin.index')}}">
              <span class="float-left">Chi Tiết</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="far fa-newspaper"></i>
              </div>
              <div class="mr-5">{{$tintuc}} Tin Tức</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('tintuc.index.public')}}">
              <span class="float-left">Chi Tiết</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-user"></i>
              </div>
              <div class="mr-5">{{$user}} User</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('user.index')}}">
              <span class="float-left">Chi Tiết</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
    </div>
@endsection
@section('script')
	<!-- Bootstrap core JavaScript-->
    <script src="{{asset('fe-admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('fe-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('fe-admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('fe-admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('fe-admin/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('fe-admin/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('fe-admin/js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{asset('fe-admin/js/sb-admin-datatables.min.js')}}"></script>
    <script src="{{asset('fe-admin/js/sb-admin-charts.min.js')}}"></script>
@endsection