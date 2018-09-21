<?php

namespace App\Http\Controllers;

use App\Theloai;
use Illuminate\Http\Request;

class TheloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $theloais = Theloai::all();
       return view('admin.theloai.theloai', compact('theloais')); 
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
    public function checkstore(Request $request) //live check ten the loai
    {
        $check = Theloai::where('tentheloai',$request->ten_the_loai)->first();
        if (isset($check)) {
            return 1;
        }
        else
            return 0;
    }
    public function store(Request $request)
    {
        $request->validate(
        [
            'tentheloai' => 'required|unique:theloais',
        ],
        [
            'tentheloai.required' => 'Chưa Nhập Tên Thể Loại',
            'tentheloai.unique' => 'Tên Thể Loại Đã Tồn Tại'
        ]);
        $tlkhongdau = $this->stripUnicode($request->tentheloai);
        $theloai = Theloai::create([
            'tentheloai' => $request->tentheloai,
            'tlkhongdau' => $tlkhongdau
        ]);
        return redirect()->route('theloai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function show(theloai $theloai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function edit(theloai $theloai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\theloai  $theloai
     * @return \Illuminate\Http\Response
     */

    public function getUpdate($id){
        $theloai = Theloai::find($id);
        return view('admin.theloai.update',compact('theloai'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
        [
            'tentheloai' => 'required'
        ],
        [
            'tentheloai.required' => 'Vui lòng nhập tên thể loại'
        ]);
        $theloai = Theloai::findOrFail($id);
        $theloai->tentheloai = $request->tentheloai;
        $theloai->tlkhongdau = $this->stripUnicode($request->tentheloai);
        $theloai->save();
        return redirect()->route('theloai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theloai = Theloai::findOrFail($id);
        $theloai->delete();
        return redirect()->route('theloai.index');
    }
}
