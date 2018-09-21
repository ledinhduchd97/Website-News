@extends('layouts.appadmin')
@section('title','Loại Tin')
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
    <li class="breadcrumb-item active">Loại Tin</li>
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
            <th>Tên Loại Tin</th>
            <th>Thể Loại Của Loại Tin</th>
            <th>Ngày Tạo</th>
            <th>Tùy Chỉnh</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>STT</th>
            <th>Tên Loại Tin</th>
            <th>Thể Loại Của Loại Tin</th>
            <th>Ngày Tạo</th>
            <th>Tùy Chỉnh</th>
          </tr>
        </tfoot>
        <tbody>
          @if(isset($loaitins))
            @foreach($loaitins as $loaitin)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$loaitin->tenloaitin}}</td>
                <td>{{$loaitin->theloai->tentheloai}}</td>
                <td>{{$loaitin->created_at}}</td>
                <td>
                  <a href="{{route('get.loaitin.update',['id'=> $loaitin->id])}}" class="btn btn-sm btn-danger">
                    <i class="fas fa-pen-fancy"></i>
                  </a>
                  <a href="{{route('get.loaitin.delete',['id'=> $loaitin->id])}}" class="btn btn-sm btn-danger">
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
    Tạo mới loại tin 
  </div>
  <form method="POST" action="{{route('post.loaitin.store')}}" accept-charset="utf-8" enctype="multipart/form-data" id="loaitin">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">Tên Loại Tin</label>
      <input class="form-control" id="exampleInputEmail1" name="tenloaitin" type="text" placeholder="Tên Loại Tin">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Thể Loại Của Loại Tin</label>
      @if(isset($theloais))   
          <select class="form-control" name="theloai_id">
            @foreach($theloais as $theloai)
              <option value="{{$theloai->id}}">{{$theloai->tentheloai}}</option>
            @endforeach
          </select>     
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
  $("#loaitin").validate({
        rules:{
            tenloaitin:{
                required:true,
                maxlength:200
            }
        },
        messages:{
            tenloaitin:{
                required:'Vui lòng nhập tên loại tin',
                maxlength:'Tên loại tin quá dài'
            }
        }
    });
</script>
@endsection