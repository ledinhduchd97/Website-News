@extends('layouts.app')
@section('title','Quên mật khẩu')
@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
			  	<div class="panel-heading">Quên mật khẩu</div>
			  	<div class="panel-body">
			    	<form method="" action="" id="login">
                         {{ csrf_field() }}
						<div style="margin-bottom: 20px;">
			    			<label>Vui lòng nhập Email</label>
                            @if($errors)
                                <label style="color: red">{{$errors->first('email')}}</label>
                            @endif
						  	<input type="email" id="email" class="form-control" placeholder="Nhập Email mà bạn đăng nhập" name="email" 
						  	>
						</div>
						<button type="submit" class="btn btn-success" id="btn-forgotpassword">Quên mật khẩu
						</button>
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
            },
            messages:{
                email:{
                    required:'Vui lòng nhập email',
                    maxlength:'Email quá dài'
                }
            }
        });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn-forgotpassword").click(function(event) {
                var email = $("#email").val();
                console.log(email);
                event.preventDefault(); //hủy sự kiện có sẵn.
                $.ajax({
                url: '{{route('post.sendmail')}}',
                type: 'POST',
                data: {email},
                success: function (data) {
                    if(data){
                         if (typeof data != "object") {
                                data = JSON.parse(data);
                            }
                        if (data==1) {
                            alert('Chúng tôi đã gửi cho bạn đường link để đặt lại mật khẩu, Bạn vui lòng kiểm tra email của mình');
                            window.location.href='https://mail.google.com';
                        }
                        else
                        {
                            alert('Email của bạn không tồn tại');
                            window.location.href='{{route('get.forgotpassword')}}';
                        }
                    }
                }
            })
        });      
    </script>
@endsection