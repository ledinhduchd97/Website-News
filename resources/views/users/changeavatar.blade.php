@extends('layouts.app')
@section('title','Đổi avatar')
@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
			  	<div class="panel-heading">Đổi avatar</div>
			  	<div class="panel-body">
			    	<form method=""  action="" accept-charset="utf-8" enctype="multipart/form-data" id="signup">
                        {{ csrf_field() }}
						<div>
                            <label>Tải ảnh avatar của bạn</label>
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('avatar')}}</label>
                                @endif
                            @endif
                            <input type="file" class="form-control" name="avatar" aria-describedby="basic-addon1" id="avatar" accept="image/*" onchange="preview_image(event)" aria-describedby="basic-addon1">
                        </div>
						<br>
                        <div class="form-group" style="margin: auto;">
                            <img id="output_image" style="width: 30%; height: 30%;" />
                        </div>
                        <br>
						<button type="submit" class="btn btn-success" id="btn_changeavatar">Đổi avatar
						</button>
			    	</form>
			  	</div>
			</div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->
@endsection
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>
    <script type="text/javascript">
        $("#signup").validate({
            rules:{
                avatar:{
                    extension: "jpg|png|gif|jepg"
                }
            },
            messages:{
                avatar:{
                    extension: 'Vui lòng chọn đúng file ảnh'
                }
            }
        });
    </script>
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
    <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });
            $("#btn_changeavatar").click(function(event) {
            event.preventDefault();
            var data = new FormData(document.getElementById('signup'));
            $.ajax({
                url: window.location.href,
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data){
                         if (typeof data != "object") {
                                data = JSON.parse(data);
                            }
                        if (data==1) {
                            alert('Đổi avatar thành công');
                            window.location.href= '{{route('index')}}' ;
                        }
                        else
                        {
                            alert('Đổi avatar thất bại');
                            window.location.href= window.location.href;
                        }
                    }
                }
            })
        });
    </script>
@endsection
