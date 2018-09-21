<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}">Tin Tức</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <form class="navbar-form navbar-left" role="search" method="get" action="{{route('search.index')}}" id="search">
            	{{ csrf_field() }}
		        <div class="form-group search">
		          <input type="text" id="keySearch" class="form-control" placeholder="Nhập tiêu đề tin" name="keyword" autocomplete="off">
                        <div id="results" class="search_results">
                        </div>
		          @if($errors)
                    <br><span class="text-danger">{{$errors->first('keyword')}}</span>
                  @endif
		        </div>                    
		        <button type="submit" class="btn btn-default">Tìm Kiếm</button>
		    </form>
            <ul class="nav navbar-nav">
                <li>
                    <a href="">Hôm nay, {{ date('d-m-Y') }}</a>
                </li>
                <li>
                    <a href="" id="textslide" style="width: 300px; overflow: hidden;
                    text-overflow: ellipsis; white-space: nowrap;"></a>
                </li>
            </ul>
		    <ul class="nav navbar-nav pull-right">
                @if(!Auth::check())
                <li>
                    <a href="{{route('get.sign_up')}}">Đăng ký</a>
                </li>
                <li>
                    <a href="{{route('get.sign_in')}}">Đăng nhập</a>
                </li>
                @endif
                <li>
                	<a id="popup_changepass">
                		<span class ="glyphicon glyphicon-user"></span>
                		@if(Auth::check())
                                {{Auth::user()->name}}
                        @endif   
                	</a>
                    <div class="popup_content">
                        <ul>
                            <li><a href="{{route('get.viewChangepass_user')}}" title="">Đổi mật khẩu</a></li>
                            <li><a href="{{route('get.changeavatar')}}" title="">Đổi avatar</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    @if(Auth::check())
                        <a href="{{route('get.logout')}}">Đăng xuất</a>
                    @endif  
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>