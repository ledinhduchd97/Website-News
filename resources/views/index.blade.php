@extends('layouts.app')
@section('title','Trang Chủ')
@section('content')
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
        <div class="col-md-12">
            @if(isset($slides))
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">  
                    @for($i=0; $i < count($slides) ; $i++)
                    @if($i==0)
                    <div class="item active">
                        <img class="slide-image" src="{{asset($slides[$i]->link)}}" alt="">
                    </div>
                    @else
                    <div class="item">
                        <img class="slide-image" src="{{asset($slides[$i]->link)}}" alt="">
                    </div>
                    @endif
                    @endfor 
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            @endif
        </div>
    </div>
    <!-- end slide -->
    <!-- slide hot news -->
    @if(isset($hots))
        @if(sizeof($hots) > 0)
            <div id="mixedSlider">
                <div class="panel-heading" style=" color:#337AB7; border-left: 5px solid #337AB7; margin-bottom: 10px;" >
                    <h3 style="margin-top:0px; margin-bottom:0px;"> Tin Nóng</h3>
                </div>
                <div class="MS-content" >
                        @foreach($hots as $hot)
                            <div class="item">
                                <div class="imgTitle">
                                    <img src="{{asset($hot->hinh)}}" alt="" style="width: 300px; height: 180px;" />
                                </div>
                                <p>{{$hot->tieude}}</p>
                                <a href="{{route('index.pagechitiet',['id'=> $hot->id , 'tieude'=> $hot->tieude])}}" style="color: #337AB7; ">Xem Tin</a>
                            </div>
                        @endforeach
                </div>
                <div class="MS-controls">
                    <button class="MS-left" style="color:#337AB7;"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                    <button class="MS-right" style="color:#337AB7;"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        @endif
    @endif  
    <!-- end slide hot news -->

    <div class="space20"></div>


    <div class="row main-left">
        <div class="col-md-3 ">
            <ul class="list-group" id="menu">
                <li href="#" class="list-group-item menu1 active">
                	Menu
                </li>
                @if(isset($menus))
                @foreach($menus as $menu)
                <li href="#" class="list-group-item menu1">
                	{{$menu->tentheloai}}
                </li>
                <ul>
                    @foreach($menu->loaitin as $sub)
            		<li class="list-group-item">
            			<a href="{{route('index.pagetintuc',['id' => $sub->id])}}">{{$sub->tenloaitin}}</a>
            		</li>
                    @endforeach
                </ul>
                @endforeach
                @endif
                <aside class="right_content">
                @if(isset($newposts))
                  <div class="single_sidebar">
                    <div class="newpost">
                    <h3><span>Tin Mới</span></h3>
                    </div>
                    <ul class="spost_nav">
                    @foreach($newposts as $newpost)
                      <li>
                        <div class="media wow fadeInDown"> <a href="{{route('index.pagechitiet',['id'=>$newpost->id,'tieude'=>$newpost->tieude])}}" class="media-left"> <img alt="" src="{{asset($newpost->hinh)}}"> </a>
                          <div class="media-body"> <a href="{{route('index.pagechitiet',['id'=>$newpost->id,'tieude'=>$newpost->tieude])}}" class="catg_title"><p>{{$newpost->tieude}}</p> </a> </div>
                        </div>
                      </li>
                    @endforeach
                    </ul>
                  </div>
                @endif
                </aside>
        </div>

        <div class="col-md-9" >
            <div class="panel panel-default">
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;"> Tin Tức</h2>
            	</div>
            	<div class="panel-body" style="background-color: #f1f1f1">
            		<!-- item -->
                    @if(isset($tinnoibat))
	            	@if(isset($menus))
	            		@foreach($menus as $menu)		
					    <div class="row-item row">
		                	<h3>
		                		<a href="#">{{$menu->tentheloai}}</a> |
		                	@foreach($menu->loaitin as $sub)
		                		<small><a href="{{route('index.pagetintuc',['id' => $sub->id])}}"><i>{{$sub->tenloaitin}}</i></a>/</small>
		                	@endforeach
		                	</h3>
		                	@foreach($menu->loaitin as $sub)
    		                	@foreach($sub->tintuc as $tt)
        		                	@if($tt->noibat==1 && $tt->trangthai==1) <!-- Lấy tin nổi bật đã public thôi -->
            		                	<div class="col-md-12 border-right">
            		                		<div class="col-md-3">
            			                        <a href="{{route('index.pagechitiet',['id' => $tt->id , 'tieude'=> $tt->tieudekhongdau])}}">
            			                            <img class="img-responsive" src="{{asset($tt->hinh)}}" alt="" style="width: 165px; height: 100px;">
            			                        </a>
            			                    </div>

            			                    <div class="col-md-9">
            			                        <h4>{{$tt->tieude}}</h4>
            			                        <!-- <p>{{$tt->tomtat}}</p> -->
            			                        <a class="btn btn-primary" href="{{route('index.pagechitiet',['id' => $tt->id,'tieude'=> $tt->tieudekhongdau])}}"> Xem Tin <span class="glyphicon glyphicon-chevron-right"></span></a>
            								</div>
            		                	</div>
        							    <div class="break"></div>
        		                	@endif
    		                	@endforeach
		                	@endforeach
                        </div>
		                @endforeach
	                @endif
                    @endif
	                @if(isset($searchs))
	                	@foreach($searchs as $search)
	                		<div class="col-md-12 border-right">
	                		<div class="col-md-3">
		                        <a href="{{route('index.pagechitiet',['id' => $search->id,'tieude'=>$search->tieudekhongdau])}}">
		                            <img class="img-responsive" src="{{asset($search->hinh)}}" alt="" style="width: 165px; height: 100px;">
		                        </a>
		                    </div>

		                    <div class="col-md-9">
		                        <h3>{{$search->tieude}}</h3>
		                        <p>{{$search->tomtat}}</p>
		                        <a class="btn btn-primary" href="{{route('index.pagechitiet',['id' => $search->id,'tieude'=>$search->tieudekhongdau])}}">Xem Tin<span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>
	                	</div>
	                	@endforeach
	                @endif
				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection
@section('js')
<script>
    $('#basicSlider').multislider({
        continuous: true,
        duration: 2000
    });
    $('#mixedSlider').multislider({
        duration: 750,
        interval: 3000
    });
</script>
</body>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
@endsection
