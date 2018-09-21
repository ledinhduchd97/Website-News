@extends('layouts.app')
@section('title','Loại Tin')
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">
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
        </div>
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    @if(isset($title))
                    <h4><b>{{$title->tenloaitin}}</b></h4>
                    @endif
                </div>
                @if(isset($tintucs))
                @foreach($tintucs as $tintuc)
                <div class="row-item row">
                    <div class="col-md-3">

                        <a href="{{route('index.pagechitiet',['id' => $tintuc->id , 'tieude' => $tintuc->tieudekhongdau])}}">
                            <br>
                            <img style="width: 165px; height: 100px;" class="img-responsive" src="{{asset($tintuc->hinh)}}" alt="">
                        </a>
                    </div>

                    <div class="col-md-9">
                        <h3>{{$tintuc->tieude}}</h3>
                        <p>{{$tintuc->tomtat}}</p>
                        <a class="btn btn-primary" href="{{route('index.pagechitiet',['id' => $tintuc->id,'tieude' => $tintuc->tieudekhongdau])}}">Xem Tin<span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <div class="break"></div>
                </div>
                @endforeach
                @endif
                <!-- Pagination -->
                <div class="row text-center">
                    <div class="col-lg-12">
                        <ul class="pagination">
                            {{$tintucs->links()}}
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div> 

    </div>

</div>
<!-- end Page Content -->
@endsection
