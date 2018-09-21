@extends('layouts.app')
@section('title','Chỉnh sửa')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/cong_tac_vien.css')}}">
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title_ctv col-md-12 col-sm-12 col-xs-12">
					<h3>Cộng Tác Viên Sửa Bài</h3>
				</div>
				<div class="form_content">
					<form action="{{route('ctv.post.update',['id'=>$tintuc->id])}}" method="post" accept-charset="utf-8" id="tintuc" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
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
				            <input class="form-control input_tieude" name="tieude" type="text" value="{{$tintuc->tieude}}">
		         		</div>
		         		<div class="form-group">
				            <label>Tóm Tắt</label>
				            <input class="form-control input_tomtat" name="tomtat" type="text" value="{{$tintuc->tomtat}}">
		          		</div>
		          		<div class="form-group">
				            <label>Tải Ảnh Cho Tin</label>
				            <input class="form-control" name="hinh" type="file" placeholder="Chọn lại ảnh cho tin">
			          	</div>
			          	<div class="form-group">
				            <label>Nội Dung</label>
				            <textarea class="form-control input_noidung" name="noidung" id="textcontent">{{$tintuc->noidung}}</textarea>
		          		</div>
		          		<button type="submit" class="btn btn-primary" style="width: 100%">Sửa Bài</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
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
