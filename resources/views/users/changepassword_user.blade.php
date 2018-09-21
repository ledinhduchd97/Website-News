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
			    	<form method="POST"  action="{{route('post.changepassword_user')}}" accept-charset="utf-8" enctype="multipart/form-data" id="signup">
                        {{ csrf_field() }}
                        <div>
                            <label>Nhập mật khẩu cũ</label>
                            
                            <input type="password" class="form-control" name="oldpassword" aria-describedby="basic-addon1" id="oldpassword">
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('oldpassword')}}</label>
                                @endif
                            @endif
                            @if(session('status'))
                                    <br>
                                    <label style="color: red">{{session('status')}}</label>
                            @endif
                        </div>
                        <br>
						<div>
			    			<label>Nhập mật khẩu mới</label> 
						  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1" id="password">
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('password')}}</label>
                                @endif
                            @endif
						</div>
						<br>
						<div>
			    			<label>Nhập lại mật khẩu mới</label>

						  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1" id="passwordAgain">  
                            @if(sizeof($errors))
                                @if($errors)
                                    <br>
                                    <label style="color: red">{{$errors->first('passwordAgain')}}</label>
                                @endif
                            @endif
						</div>
						<br>
						<button type="submit" class="btn btn-success">Đổi mật khẩu
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
                oldpassword:{
                    required:true
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
                oldpassword:{
                    required:'Vui lòng nhập mật khẩu cũ'
                }
                ,
                password:{
                    required:'Vui lòng nhập mật khẩu mới',
                    maxlength:'Mật khẩu quá dài',
                    minlength:'Mật khẩu quá ngắn'
                },
                passwordAgain:{
                    required:'Vui lòng nhập nhắc lại mật khẩu mới',
                    equalTo: 'Nhắc lại mật khẩu không trùng khớp'
                }
            }
        });
    </script>
@endsection
