@extends('layouts.appadmin')
@section('title','Thể Loại')
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
        <li class="breadcrumb-item active">Thể Loại</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>
          Bảng dữ liệu thể loại
        </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tên Thể Loại</th>
                <th>Ngày Tạo</th>
                <th>Tùy Chỉnh</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>STT</th>
                <th>Tên Thể Loại</th>
                <th>Ngày Tạo</th>
                <th>Tùy Chỉnh</th>
              </tr>
            </tfoot>
            <tbody>
              @if(isset($theloais))
                @foreach($theloais as $theloai)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$theloai->tentheloai}}</td>
                    <td>{{$theloai->created_at}}</td>
                    <td>
                      <a href="{{route('get.theloai.update',['id'=>$theloai->id])}}" class="btn btn-sm btn-danger">
                        <i class="fas fa-pen-fancy"></i>
                      </a>
                      <a href="{{route('get.theloai.delete',['id'=>$theloai->id])}}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i>
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
    <div class="card-body">
        <div class="card-header form-card" style="margin-bottom: 10px;">
          <i class="fa fa-table"></i>
          Tạo Mới Thể Loại
        </div>
        <form method="POST" action="{{route('post.theloai.store')}}" accept-charset="utf-8" enctype="multipart/form-data" id="theloai">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="ten_the_loai">Tên Thể Loại</label>
            <input class="form-control" name="tentheloai" type="text" placeholder="Tên Thể Loại" id="ten_the_loai" autocomplete="off">
            @if(sizeof($errors) != 0)
              @if($errors)
                <br><span class="text-danger">{{$errors->first('tentheloai')}}</span>
              @endif
            @endif
            <div class="alert-danger alert_mes" style="margin-top: 10px"></div>
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%">Tạo Mới</button>
        </form>
    </div>    
    </div>
@endsection
@section('script')
 <!-- Bootstrap core JavaScript-->
    <script src="{{asset('fe-admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('fe-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('fe-admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('fe-admin/vendor/chart.js/chart.js')}}"></script>
    <script src="{{asset('fe-admin/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('fe-admin/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('fe-admin/js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{asset('fe-admin/js/sb-admin-datatables.min.js')}}"></script>
    <script src="{{asset('fe-admin/js/sb-admin-charts.min.js')}}"></script>
    <script src="{{asset('js/jquery-validate/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery-validate/additional-methods.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
      $("#theloai").validate({
            rules:{
                tentheloai:{
                    required:true,
                    maxlength:200
                }
            },
            messages:{
                tentheloai:{
                    required:'Vui lòng nhập tên thể loại',
                    maxlength:'Tên thể loại quá dài'
                }
            }
        });
      $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
      });
      $("#ten_the_loai").keyup(function(event) {
        var ten_the_loai = $("#ten_the_loai").val();
        if(ten_the_loai != '')
        {
          $.ajax({
            url: '{{route('post.theloai.checkstore')}}',
            type: 'POST',
            dataType: 'html',
            data: {ten_the_loai},
            success:function(data)
              {
                  if (data==1) {
                      $(".alert_mes").html("Tên Thể Loại Đã Tồn Tại");
                  }
                  else
                      $(".alert_mes").html('');
              }
          })         
        }
        else
        {
          $(".alert_mes").html('');
        }
      });
    </script>
@endsection