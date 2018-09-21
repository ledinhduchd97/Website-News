@extends('layouts.appadmin')
@section('title','Quản Lí Slide')
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
        <li class="breadcrumb-item active">Slide</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>
          Bảng dữ liệu slide
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên Ảnh</th>
                  <th>Ảnh</th>
                  <th>Xóa Ảnh</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>STT</th>
                  <th>Tên Ảnh</th>
                  <th>Ảnh</th>
                  <th>Xóa Ảnh</th>
                </tr>
              </tfoot>
              <tbody>
                  @if(isset($slides))
                    @foreach($slides as $slide)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$slide->ten}}</td>
                        <td><img src="{{asset($slide->link)}}" alt=""></td>
                        <td>
                          <a href="{{route('slide.destroy',['id'=>$slide->id])}}" class="btn btn-sm btn-danger">
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
          Tải Slide Mới (Bạn Vui Lòng Chọn Ảnh 800*300)
        </div>
        <form method="POST" action="{{route('slide.store')}}" accept-charset="utf-8" enctype="multipart/form-data" id="slide">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="exampleInputEmail1">Tên Của Ảnh</label>
            <input class="form-control" id="exampleInputEmail1" name="ten" type="text"  placeholder="Tên Của Ảnh">
            @if($errors)
              <br><span class="text-danger">{{$errors->first('ten')}}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Chọn Ảnh</label>
            <input class="form-control" id="exampleInputEmail1" name="link" type="file"  placeholder="Chọn Ảnh" accept="image/*" onchange="preview_image(event)">
            @if($errors)
              <br><span class="text-danger">{{$errors->first('link')}}</span>
            @endif
          </div>
          <div class="form-group">
            <img id="output_image" style="width: 100%; height: 100%;" />
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

<script type='text/javascript'>
function preview_image(event) 
{
   var reader = new FileReader();
   reader.onload = function()
   {
    var output = document.getElementById('output_image');
    output.src = reader.result;
   }
   reader.readAsDataURL(event.target.files[0]);
}
</script>
<script src="{{asset('js/jquery-validate/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-validate/additional-methods.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $("#slide").validate({
        rules:{
            ten:{
                required:true,
                maxlength:200
            },
            link:{
                extension: "jpg|png|gif|jepg"
            }
        },
        messages:{
            ten:{
                required:'Vui lòng nhập tên slide',
                maxlength:'Tên Slide quá dài'
            },
            link:{
                extension: 'Vui lòng chọn đúng file ảnh'
            }
        }
    });
</script>
@endsection