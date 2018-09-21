@extends('layouts.appadmin')
@section('title','Tin Tức Đã Đăng')
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
        <li class="breadcrumb-item active">Đăng tin</li>
      </ol>
      <div class="card-body">
      <div class="card-header form-card" style="margin-bottom: 10px;">
        <i class="fa fa-table"></i>
        Tạo mới tin tức
      </div>
        <form method="POST" action="{{route('post.tintuc.store')}}" accept-charset="utf-8" enctype="multipart/form-data" id="tintuc">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Chọn loại tin cho tin</label>
            @if(isset($loaitins))
              <select class="form-control" name="loaitin_id">
                @foreach($loaitins as $loaitin)
                  <option value="{{$loaitin->id}}">{{$loaitin->tenloaitin}}</option>
                @endforeach
              </select>
            @endif
          </div>
          <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="tieude" type="text" placeholder="Tiêu Đề">
            @if($errors)
              <label style="color: red">{{$errors->first('tieude')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Tóm Tắt</label>
            <input class="form-control" name="tomtat" type="text" placeholder="Tóm Tắt">
            @if($errors)
              <label style="color: red">{{$errors->first('tomtat')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Tải Ảnh Cho Tin (Vui Lòng Chọn Ảnh 825*465)</label>
            <input class="form-control" name="hinh" type="file" placeholder="Ảnh Cho Tin">
            @if($errors)
              <label style="color: red">{{$errors->first('hinh')}}</label>
            @endif
          </div>
          <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" name="noidung" id="textcontent"></textarea>
            @if($errors)
              <label style="color: red">{{$errors->first('noidung')}}</label>
            @endif
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
@endsection