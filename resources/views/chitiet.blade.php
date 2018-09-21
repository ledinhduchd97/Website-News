@extends('layouts.app')
@section('title','Chi Tiết Tin')
@section('meta')
    <meta property="og:url" content="<?php
       $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       echo($url)
    ?>">
    <meta property="og:title" content="{{$tintuc->tieude}}">
    <meta property="og:image" content="{{asset($tintuc->hinh)}}">
    <meta property="og:site_name" content="Web Tin Tức">
    <meta property="og:type" content="website">
@endsection
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        @if(isset($tintuc))
        <!-- Blog Post Content Column -->
        <div class="col-lg-9" id="add__comment">
            <!-- Blog Post -->
            <!-- Title -->
            <h1>{{$tintuc->tieude}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">{{$tintuc->usertintuc->name}}</a>
            </p>
            <!-- Preview Image -->
            <img class="img-responsive" src="{{asset($tintuc->hinh)}}" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <div class="lead">{!!$tintuc->noidung!!}</div>
            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form onsubmit="false" accept-charset="utf-8" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="content" id="content" style="height: 100px;"></textarea>
                        @if($errors)
                        <br><span class="text-danger">{{$errors->first('content')}}</span>
                        @endif
                    </div>  
                    <input type="submit" class="btn btn-primary" id="comment" value="Bình Luận" />
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @if(isset($comments))
            @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{asset($comment->user->avatar)}}" alt="" style="width: 60px; height: 60px;">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name}}
                        <small>{{$comment->created_at}}</small>
                    </h4>
                    {{$comment->content}}
                    <a href="{{route('del.comment.pagechitiet', ['id' => $comment->id])}}" class="btn btn-sm btn-danger destroycmt" id = "destroycmt" style="float: right">
                    <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        @endif

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    @if(isset($tintuclienquans))
                        @foreach($tintuclienquans as $tintuclienquan)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="{{route('index.pagechitiet',['id'=>$tintuclienquan->id, 'tieude' => $tintuclienquan->tieudekhongdau ])}}">
                                        <img class="img-responsive" src="{{asset($tintuclienquan->hinh)}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="#"></a>
                                </div>
                                <p><b>{{$tintuclienquan->tieude}}</b></p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                    @if(isset($tintucnoibats))
                        @foreach($tintucnoibats as $tintucnoibat)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="{{route('index.pagechitiet',['id'=>$tintucnoibat->id, 'tieude' => $tintucnoibat->tieudekhongdau])}}">
                                        <img class="img-responsive" src="{{asset($tintucnoibat->hinh)}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{route('index.pagechitiet',['id'=>$tintucnoibat->id,'tieude' => $tintucnoibat->tieudekhongdau])}}"><!-- <b>{{$tintucnoibat->tieude}}</b> --></a>
                                </div>
                                <p><b>{{$tintucnoibat->tieude}}</b></p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
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
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $("#comment").click(session);
    function session(){
        $.ajax({
            url:'{{route('comment.pagechitiet',['id' => $tintuc->id])}}',
            method: "POST",
            data:{
                content:$("#content").val()
            },
            success:function(data){
                if (data == 1) {
                    alert('Vui lòng đăng nhập để có thể bình luận');
                    window.location.href='{{route('get.sign_in')}}';
                }else{
                    $('#add__comment').append(`
                        <div class="media">
                        <a class="pull-left" href="">
                            <img class="media-object" src="{{asset('${data.user.avatar}')}}" alt="" style="width: 60px; height: 60px;">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">${data.user.name}
                                <small>${data.data.created_at}</small>
                            </h4>
                            ${data.data.content}
                            <a href="${data.linkdelete}" class="btn btn-sm btn-danger destroycmt" style="float: right">
                             <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </div>`);
                    $(".destroycmt").click(destroy);
                }
                $("#content").val('');
            }
        });
        return false;
    }
    $(".destroycmt").click(destroy);
    function destroy(){
        @if (isset($comment) && sizeof($comment)>0)
            $.ajax({
                url:'{{route('del.comment.pagechitiet', ['id' => $comment->id])}}',
                method: "GET",
                success:function(data){
                    if (data==1) {
                        alert('Bạn cần đăng nhập để xóa được bình luận');
                        window.location.href='{{route('get.sign_in')}}';
                    }
                    else if(data==2){
                        alert('Bạn không thể xóa bình luận của người khác');
                    }
                    else
                    {
                         window.location.href='{{route('index.pagechitiet',['id'=> $comment->tintuccmt->id,'tieude'=>$comment->tintuccmt->tieude])}}';
                    }
                }
            });
            return false;
        @endif
    }
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b480b07370266de"></script>

@endsection