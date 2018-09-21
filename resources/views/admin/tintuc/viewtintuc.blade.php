@extends('layouts.app')
@section('title','Chi Tiết Tin')
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
                
            </div>
            <hr>
            <!-- button -->
            @if($tintuc->trangthai == 0)
            <a href="{{route('tintuc.accept.private',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-success">Duyệt Bài</button></a>
            @endif
            @if($tintuc->noibat == 0)
            <a href="{{route('get.tintuc.highlight',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-success">Chọn Làm Bài Nổi Bật</button></a>
            @endif
            @if($tintuc->tinnong == 0)
            <a href="{{route('get.tintuc.hotnews',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-success">Chọn Làm Tin Nóng</button></a>
            @endif
            <a href="{{route('post.tintuc.destroypublic',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-danger">Xóa Bài</button></a>
            @if($tintuc->tinnong == 1)
            <a href="{{route('get.tintuc.unhotnews',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-danger">Hủy Tin Nóng</button></a>
            @endif
            @if($tintuc->noibat == 1)
            <a href="{{route('get.tintuc.unhighlight',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-danger">Hủy Tin Nổi Bật</button></a>
            @endif
            <!-- end button -->
        </div>
        @endif
    
        <!-- Blog Sidebar Widgets Column -->

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection
