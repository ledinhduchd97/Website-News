<p>Xin chào {{$user->name}}</p>
<p>Dưới đây là đường link giúp bạn đặt lại mật khẩu mới</p>
<p><a href="{{route('get.changepassword',['token'=>$user->verifytoken,'id'=>$user->id])}}">Click here</a></p>