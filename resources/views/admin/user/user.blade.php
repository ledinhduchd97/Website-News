@extends('layouts.appadmin')
@section('title','Quản Lí Người Dùng')
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
        <li class="breadcrumb-item active">User</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>
          Bảng dữ liệu người dùng
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Chức Vụ</th>
                  <th>Ngày Khởi Tạo</th>
                  <th>Xóa Tài Khoản</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>STT</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Chức vụ</th>
                  <th>Ngày Khởi Tạo</th>
                  <th>Xóa Tài Khoản</th>
                </tr>
              </tfoot>
              <tbody>
                @if(isset($users))
                  @foreach($users as $user)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->level == 0 ? 'Người Dùng' : 'Cộng tác viên'}}</td>
                      <td>{{$user->created_at}}</td>
                      <td>
                        <a href="{{route('get.user.delete',['id'=>$user->id])}}" class="btn btn-sm btn-danger">
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
          Đăng Kí Tài Khoản Cho Cộng Tác Viên
        </div>
        <form method="POST" action="{{route('post.user.store')}}" accept-charset="utf-8" enctype="multipart/form-data" id="user">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" type="text"  placeholder="Enter Name">
            @if(sizeof($errors) != 0)
              @if($errors)
                <br><span class="text-danger">{{$errors->first('name')}}</span>
              @endif
            @endif
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
            @if(sizeof($errors) != 0)
              @if($errors)
                <br><span class="text-danger">{{$errors->first('email')}}</span>
              @endif
            @endif
            <div class="alert-danger alert_mes" style="margin-top: 10px;"></div>
          </div>
          <div class="form-group">
            <label for="avatar">Avatar</label>
            <input class="form-control" id="avatar" name="avatar" type="file" aria-describedby="emailHelp" placeholder="Avatar">
            @if($errors)
              <br><span class="text-danger">{{$errors->first('avatar')}}</span>
            @endif
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="password">Password</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Password">
                @if($errors)
                  <br><span class="text-danger">{{$errors->first('password')}}</span>
                @endif
              </div>
              
              <div class="col-md-6">
                <label for="passwordAgain">Confirm password</label>
                <input class="form-control" id="passwordAgain" name="passwordAgain" type="password" placeholder="Confirm password">
                @if($errors)
                  <br><span class="text-danger">{{$errors->first('passwordAgain')}}</span>
                @endif
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%">Tạo Mới</button>
        </form>
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
<script src="{{asset('js/jquery-validate/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-validate/additional-methods.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $("#user").validate({
        rules:{
          name:{
              required:true,
          },
          email:{
              required:true,
              maxlength:200
          },
          avatar:{
              extension: "jpg|png|gif|jepg"
          },
          password:{
              required:true,
              maxlength:50,
              minlength:6
          },
          passwordAgain:{
              required:true,
              equalTo: "#password"
          }
      },
      messages:{
          name:{
              required:'Vui lòng nhập tên',
          },
          email:{
              required:'Vui lòng nhập email',
              maxlength:'Email quá dài'
          },
          avatar:{
              extension: 'Vui lòng chọn đúng file ảnh'
          },
          password:{
              required:'Vui lòng nhập mật khẩu',
              maxlength:'Mật khẩu quá dài',
              minlength:'Mật khẩu quá ngắn'
          },
          passwordAgain:{
              required:'Vui lòng nhập nhắc lại mật khẩu',
              equalTo: 'Nhắc lại mật khẩu không trùng khớp'
          }
      }
    });
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
  });
  $("#email").keyup(function(event) {
      var email = $("#email").val();
      if(email != '')
      {
         $.ajax({
              url: '{{route('post.checkEmail')}}',
              type: 'POST',
              dataType: 'html',
              data: {email},
              success:function(data)
              {
                  if (data==1) {
                      $(".alert_mes").html("Email đã tồn tại");
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