@extends('layouts.app')
@section('title','Cộng tác viên')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/cong_tac_vien.css')}}">
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="menu_post">
					<div class="menu_title">
						<h4>Bài viết đang chờ duyệt</h4>
					</div>
					<div class="menu_content">
						<ul>
							@if(isset($tin_dang_doi))
								@foreach($tin_dang_doi as $tin)
									<li>
										<div class="image_new">
											<img src="{{asset($tin->hinh)}}" alt="">
										</div>
										<div class="title_new">
											<p><a href="{{route('ctv.view',['id'=>$tin->id])}}" title="">{{$tin->tieude}}</a></p>
										</div>
										<div class="clearfix"></div>
									</li>
								@endforeach
							@endif
						</ul>
					</div>
					<div class="row text-center">
                    <div class="col-lg-12">
                        <ul class="pagination">
                            {{$tin_dang_doi->links()}}
                        </ul>
                    </div>
                </div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="title_ctv col-md-12 col-sm-12 col-xs-12">
					<h3>Cộng Tác Viên Viết Bài</h3>
				</div>
				<div class="form_content">
					<form action="{{route('ctv.store')}}" method="post" accept-charset="utf-8" id="tintuc" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Chọn loại tin cho tin</label>
							<select class="form-control" name="loaitin_id">
				                  <option value="">Chọn loại tin</option>
				                  @if(isset($loaitin))
				                  	@foreach($loaitin as $lt)
				                  		<option value="{{$lt->id}}">{{$lt->tenloaitin}}</option>
				                  	@endforeach
				                  @endif
		              		</select>
						</div>
						<div class="form-group">
				            <label>Tiêu Đề</label>
				            <input class="form-control input_tieude" name="tieude" type="text" placeholder="Tiêu Đề">
		         		</div>
		         		<div class="form-group">
				            <label>Tóm Tắt</label>
				            <input class="form-control input_tomtat" name="tomtat" type="text" placeholder="Tóm Tắt">
		          		</div>
		          		<div class="form-group">
				            <label>Tải Ảnh Cho Tin</label>
				            <input class="form-control" name="hinh" type="file" placeholder="Ảnh Cho Tin">
			          	</div>
			          	<div class="form-group">
				            <label>Nội Dung</label>
				            <textarea class="form-control input_noidung" name="noidung" id="textcontent"></textarea>
		          		</div>
		          		<button type="submit" class="btn btn-primary" style="width: 100%">Đăng Bài</button>
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
