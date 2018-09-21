@extends('layouts.app')
@section('title','Đổi mật khẩu')
@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
			  	<div class="panel-heading">Đổi mật khẩu</div>
			  	<div class="panel-body">
			    	<form method=""  action="" accept-charset="utf-8" enctype="multipart/form-data" id="signup">
                        {{ csrf_field() }}
						<div>
			    			<label>Nhập mật khẩu mới</label>
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
			    			<label>Nhập lại mật khẩu mới</label>
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('passwordAgain')}}</label>
                                @endif
                            @endif
						  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1" id="passwordAgain">
						</div>
						<br>
						<button type="submit" class="btn btn-success" id="btn_changepassword">Đổi mật khẩu
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
                email:{
                    required:true,
                    maxlength:200
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
                email:{
                    required:'Vui lòng nhập email',
                    maxlength:'Email quá dài'
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
        $("#btn_changepassword").click(function(event) {
            event.preventDefault();
            var password = $("#password").val();
            var passwordAgain = $("#passwordAgain").val();
            // var urlall = $(location).attr('pathname');
            // var url = urlall.split("/",10);
            $.ajax({
                url: window.location.href,
                type: 'POST',
                data: {password,passwordAgain},
                success: function (data) {
                    if(data){
                         if (typeof data != "object") {
                                data = JSON.parse(data);
                            }
                        if (data==1) {
                            alert('Đổi mật khẩu thành công');
                            window.location.href= '{{route('get.sign_in')}}' ;
                        }
                        else
                        {
                            alert('Đổi mật khẩu thất bại');
                            window.location.href= window.location.href;
                        }
                    }
                }
            })
        });
    </script>
@endsection
