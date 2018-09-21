<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Chỉnh sửa thể loại</title>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('fe-admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('fe-admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset('fe-admin/css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Chỉnh Sửa Thể Loại</div>
      <div class="card-body">
        <form method="POST" action="" accept-charset="utf-8" enctype="multipart/form-data" id="theloai">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="exampleInputEmail1">Tên Thể Loại</label>
            <input class="form-control" id="exampleInputEmail1" name="tentheloai" type="text" placeholder="Tên Thể Loại" value="{{$theloai->tentheloai}}">
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%">Chỉnh Sửa</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('fe-admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('fe-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('fe-admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
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
  </script>
</body>

</html>
