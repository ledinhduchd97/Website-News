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
            <a href="{{route('ctv.get.update',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-danger">Sửa Bài</button></a>
            <a href="{{route('ctv.get.delete',['id'=>$tintuc->id])}}" title=""><button type="button" class="btn btn-danger">Xóa Bài</button></a>
        </div>
        @endif
    
        <!-- Blog Sidebar Widgets Column -->

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection