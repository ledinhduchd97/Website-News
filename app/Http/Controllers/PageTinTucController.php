<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Slide;
use App\Theloai;
use App\Loaitin;
use App\Tintuc;

class PageTinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $menus = Theloai::all();
      $title = Loaitin::where('id',$id)->first();
      $tintucs = Tintuc::where('loaitin_id',$id)->where('trangthai',1)->paginate(5);
      return view('loaitin',compact('menus','tintucs','title')); 
    }
    public function search(Request $request,$id)
    {
        $request->validate([
            'keyword' => 'required'
        ],
        [
            'keyword.required' => 'Vui lòng nhập tiêu đề tin cần tìm'
        ]);
        $menus = Theloai::all();
        $title = Loaitin::where('id',$id)->first();
        $keyword = $request->keyword;
        $tintucs = Tintuc::where('loaitin_id',$id)->where('tieude','like', '%'.$keyword.'%')->where('trangthai',1)->paginate(5);
        $tintucs->withPath("?keyword=$keyword");
        return view('loaitin',compact('menus','title','tintucs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
