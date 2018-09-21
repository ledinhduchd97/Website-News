@extends('layouts.app')
@section('title','Đăng Nhập')
@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
			  	<div class="panel-heading">Đăng nhập</div>
			  	<div class="panel-body">
			    	<form method="post" action="" id="login">
                         {{ csrf_field() }}
						<div>
			    			<label>Email</label>
                            @if($errors)
                                <label style="color: red">{{$errors->first('email')}}</label>
                            @endif
						  	<input type="email" class="form-control" placeholder="Email" name="email" 
						  	>
						</div>
						<br>	
						<div>
			    			<label>Mật khẩu</label>
                            @if($errors)
                                <label style="color: red">{{$errors->first('password')}}</label>
                            @endif
						  	<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<br>
                        <div class="checkrem">
                            <input class="checkbox-inline" type="checkbox" name="remember" id="rem">
                            <div class="remember"><label for="rem">Ghi nhớ</label></div>
                        </div>
						<button type="submit" class="btn btn-success">Đăng nhập
						</button>
                        <label><a href="{{route('get.forgotpassword')}}">Quên mật khẩu</a></label>
			    	</form>
			  	</div>
			</div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->
@endsection
@section('js')
	<script type="text/javascript">
        $("#login").validate({
            rules:{
                email:{
                    required:true,
                    maxlength:200
                },
                password:{
                	required:true,
                	maxlength:50
                }
            },
            messages:{
                email:{
                    required:'Vui lòng nhập email',
                    maxlength:'Email quá dài'
                },
                password:{
                	required:'Vui lòng nhập mật khẩu',
                	maxlength:'Mật khẩu quá dài'
                }
            }
        });
    </script>
@endsection