@extends('layouts.app')
@section('title','Đăng kí')
@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
			  	<div class="panel-heading">Đăng ký tài khoản</div>
			  	<div class="panel-body">
			    	<form method=""  action="" accept-charset="utf-8" enctype="multipart/form-data" id="signup">
                        {{ csrf_field() }}
			    		<div>
			    			<label>Họ tên</label>
                            @if($errors)
                                <br>
                                <label style="color: red">{{$errors->first('name')}}</label>
                            @endif
						  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" id="name">                               
						</div>
						<br>
						<div class="email">
			    			<label>Email</label>
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('email')}}</label>
                                @endif
                            @endif
						  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
						  	 id="email" autocomplete="off">
                             <div class="alert-danger alert_mes" style="margin-top: 10px;"></div>
						</div>
                        <br>    
                        <div>
                            <label>Tải ảnh avatar của bạn</label>
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('avatar')}}</label>
                                @endif
                            @endif
                            <input type="file" class="form-control" name="avatar" aria-describedby="basic-addon1" id="avatar">
                        </div>
						<br>	
						<div>
			    			<label>Nhập mật khẩu</label>
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('password')}}</label>
                                @endif
                            @endif
						  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1" id="password">
						</div>
						<br>
						<div>
			    			<label>Nhập lại mật khẩu</label>
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('passwordAgain')}}</label>
                                @endif
                            @endif
						  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1" id="passwordAgain">
						</div>
						<br>
						<button type="submit" class="btn btn-success" id="btn_sign_up">Đăng ký
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
                }
                ,
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
        $("#btn_sign_up").click(function(event) {
            event.preventDefault();
            var data = new FormData(document.getElementById('signup'));
            $.ajax({
                url: '{{route('post.sign_up')}}', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function (data) {
                    parseInt(data);
                        console.log(data);
                        if (data==1) {
                            alert('Bạn đã đăng kí thành công, Vui lòng đăng nhập');
                            window.location.href='{{route('get.sign_in')}}';
                        }
                        else
                        {
                            alert('Đăng kí thất bạt');
                            window.location.href='{{route('get.sign_up')}}';
                        }  
                }
            });
        });
    </script>
@endsection
