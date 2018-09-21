<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Theloai;
use Illuminate\Http\Request;

class LoaitinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loaitins = Loaitin::all();
        $theloais = Theloai::all();
        return view('admin.loaitin.loaitin',compact('loaitins','theloais'));
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
    public function stripUnicode($str){
      if(!$str) return false;
       $unicode = array(
          'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
          'd'=>'đ',
          'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
          'i'=>'í|ì|ỉ|ĩ|ị',
          'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
          'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
          'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
       );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }
    public function store(Request $request)
    {
        $request->validate(
        [
            'tenloaitin' => 'required|unique:loaitins'
        ],
        [
            'tenloaitin.required' => 'Bạn vui lòng nhập tên loại tin',
            'tenloaitin.unique' => 'Tên Loại Tin Đã Tồn Tại'
        ]);
        $loaitin = Loaitin::create([
            'tenloaitin' => $request->tenloaitin,
            'ltkhongdau' => $this->stripUnicode($request->tenloaitin),
            'theloai_id' => $request->theloai_id
        ]);
        return redirect()->route('loaitin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\loaitin  $loaitin
     * @return \Illuminate\Http\Response
     */
    public function show(loaitin $loaitin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\loaitin  $loaitin
     * @return \Illuminate\Http\Response
     */
    public function edit(loaitin $loaitin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\loaitin  $loaitin
     * @return \Illuminate\Http\Response
     */
    public function getUpdate($id){
        $loaitin = Loaitin::findOrFail($id);
        $theloais = Theloai::all();
        return view('admin.loaitin.update',compact('loaitin','theloais'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
        [
          'tenloaitin' => 'required'  
        ],
        [
            'tenloaitin.required' => 'Bạn vui lòng nhập tên loại tin'
        ]);
        $loaitin = Loaitin::findOrFail($id);
        $loaitin->tenloaitin = $request->tenloaitin;
        $loaitin->ltkhongdau = $this->stripUnicode($request->tenloaitin);
        $loaitin->theloai_id = $request->theloai_id;
        $loaitin->save();
        return redirect()->route('loaitin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\loaitin  $loaitin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loaitin = Loaitin::findOrFail($id);
        $loaitin->delete();
        return redirect()->route('loaitin.index');
    }
}
