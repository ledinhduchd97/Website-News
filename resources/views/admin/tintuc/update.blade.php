<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Chỉnh sửa tin tức</title>
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
      <div class="card-body">
      <div class="card-header form-card" style="margin-bottom: 10px;">
        <i class="fa fa-table"></i>
        Chỉnh sửa tin tức
      </div>
        <form method="POST" action="" accept-charset="utf-8" enctype="multipart/form-data" id="tintuc">
          <div class="form-group">
            {{ csrf_field() }}
            <label>Chọn loại tin cho tin</label>
            <select class="form-control" name="loaitin_id">
                <option value="{{$tintuc->tintuctl->id}}">{{$tintuc->tintuctl->tenloaitin}}</option>
                @if(isset($loaitins))
                  @foreach($loaitins as $lt)
                    @if($lt->id != $tintuc->tintuctl->id)
                      <option value="{{$lt->id}}">{{$lt->tenloaitin}}</option>
                    @endif
                  @endforeach
                @endif
            </select>
          </div>
          <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" type="text" name="tieude" placeholder="Tiêu Đề" value="{{$tintuc->tieude}}">
            @if($errors)
              <label style="color: red">{{$errors->first('tieude')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Tóm Tắt</label>
            <input class="form-control" type="text" name="tomtat" placeholder="Tóm Tắt" value="{{$tintuc->tomtat}}">
            @if($errors)
              <label style="color: red">{{$errors->first('tomtat')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Tải Ảnh Cho Tin (Vui Lòng Chọn Ảnh 825*465)</label>
            <input class="form-control" type="file" name="hinh" placeholder="Ảnh Cho Tin">
            <!-- <img class="img-responsive" src="{{asset($tintuc->hinh)}}" alt="" style="width: 100px; height: 100px"> -->
            @if($errors)
              <label style="color: red">{{$errors->first('hinh')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" id="textcontent" name="noidung">{!! $tintuc->noidung !!}</textarea>
            @if($errors)
              <label style="color: red">{{$errors->first('noidung')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Trạng Thái</label>
              <select class="form-control" name="trangthai">
                  @if($tintuc->trangthai == 0)
                    <option value="0">Đang đợi</option>
                    <option value="1">Đã đăng</option>
                  @else
                    <option value="1">Đã đăng</option>
                    <option value="0">Đang đợi</option>
                  @endif
              </select>
          </div>   
          <button type="submit" class="btn btn-primary" style="width: 100%">Chỉnh sửa</button>
        </form>
    </div>     
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('fe-admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('fe-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('fe-admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script>
      tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        plugins : 'advlist lists charmap print preview'
      });
  </script>
  <script src="{{asset('js/jquery-validate/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-validate/additional-methods.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $("#tintuc").validate({
        rules:{
            tieude:{
                required:true,
                maxlength:400,
                minlength:6
            },
            tomtat:{
                required:true
            },
            hinh:{
                extension: "jpg|png|gif|jepg"
            },
            noidung:{
                required:true
            }
        },
        messages:{
            tieude:{
                required:'Vui lòng nhập tiêu đề',
                maxlength:'Tiêu đề quá dài',
                minlength:'Tiêu đề quá ngắn'
            },
            tomtat:{
                required:'Vui lòng nhập tóm tắt'
            },
            hinh:{
                extension:'Vui lòng chọn đúng file ảnh'
            },
            noidung:{
                required:'Vui lòng nhập nội dung'
            }
        }
    });
</script>
</body>

</html>
