@extends('layouts.appadmin')
@section('title','Tin Tức Đang Đợi')
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tin tức đang đợi</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>
          Bảng dữ liệu tin tức
        </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tiêu Đề</th>
                <th>Người Viết</th>
                <th>Loại Tin Của Tin</th>
                <th>Ngày Viết</th>
                <th>Xóa</th>
                <th>Duyệt</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>STT</th>
                <th>Tiêu Đề</th>
                <th>Người Viết</th>
                <th>Loại Tin Của Tin</th>
                <th>Ngày Viết</th>  
                <th>Xóa</th>
                <th>Duyệt</th>
              </tr>
            </tfoot>
            <tbody>
              @if(isset($tintucs))
                @foreach($tintucs as $tintuc)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{route('get.tintuc.view',['id'=>$tintuc->id])}}" title="" style="text-decoration: none;">{{$tintuc->tieude}}</a></td>
                    <td>{{$tintuc->usertintuc->name}}</td>
                    <td>{{$tintuc->tintuctl->tenloaitin}}</td>
                    <td>{{$tintuc->created_at}}</td>
                    <td>
                      <a href="{{route('post.tintuc.destroyprivate',['id'=>$tintuc->id])}}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> <!-- xóa -->
                      </a>
                    </td>
                    <td>
                      <a href="{{route('tintuc.accept.private',['id'=>$tintuc->id])}}" class="btn btn-sm btn-danger">
                        <i class="fas fa-thumbs-up"></i> <!-- duyệt -->
                      </a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>   
    </div>
    </div>
@endsection
@section('script')
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
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script>
      tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        plugins : 'advlist lists charmap print preview'
      });
  </script>
@endsection