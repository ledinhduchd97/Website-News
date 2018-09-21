<?php

namespace App\Http\Controllers;

use App\Tintuc;
use App\Loaitin;
use Auth;
use Illuminate\Http\Request;

class TintucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postnew()
    {
        $loaitins = Loaitin::all();
        return view('admin.tintuc.dangtin',compact('loaitins'));
    }
    public function indexpublic() // các tin đã đăng 
    {
        $tintucs = Tintuc::where('trangthai',1)->get();
        $loaitins = Loaitin::all();
        return view('admin.tintuc.tintucpublic',compact('tintucs','loaitins'));
    }
    public function gethotnews(){
        $tintucs = Tintuc::where('trangthai',1)->where('tinnong',1)->get();
        return view('admin.tintuc.hotnews',compact('tintucs'));
    }
    public function gethighlightnews(){
        $tintucs = Tintuc::where('trangthai',1)->where('noibat',1)->get();
        return view('admin.tintuc.highlightnews',compact('tintucs'));
    }
    public function highlight($id){ //duyệt tin làm tin nổi bật
        $highlight = Tintuc::findOrFail($id);
        $highlight->noibat = 1;
        $highlight->save();
        return redirect()->route('tintuc.index.public');
    }
    public function unhighlight($id){ //hủy tin nổi bật
        $highlight = Tintuc::findOrFail($id);
        $highlight->noibat = 0;
        $highlight->save();
        return redirect()->route('tintuc.index.public');
    }
    public function hotnews($id){ //duyệt tin làm tin nóng
        $hotnews = Tintuc::findOrFail($id);
        $hotnews->tinnong = 1;
        $hotnews->save();
        return redirect()->route('tintuc.index.public');
    }
    public function unhotnews($id){ //hủy tin nóng
        $hotnews = Tintuc::findOrFail($id);
        $hotnews->tinnong = 0;
        $hotnews->save();
        return redirect()->route('tintuc.index.public');
    }
    public function viewtintuc($id){ //xem chi tiết tin
        $tintuc = Tintuc::findOrFail($id);
        return view('admin.tintuc.viewtintuc',compact('tintuc'));
    }

    public function indexprivate() // các tin đang đợi duyệt
    {
        $tintucs = Tintuc::where('trangthai',0)->get();
        return view('admin.tintuc.tintucprivate',compact('tintucs'));
    }

    public function accept($id) //duyệt tin tức của cộng tác viên gửi lên
    {
        $accept = Tintuc::findOrFail($id);
        $accept->trangthai = 1;
        $accept->save();
        return redirect()->route('tintuc.index.private');
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
    public function stripUnicode($str){ //hàm đổi chữ có dấu thành không dấu
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
    public function storepublic(Request $request) // admin đăng tin
    {
        $request->validate([
            'loaitin_id' => 'required',
            'tieude' => 'required',
            'tomtat' => 'required',
            'noidung' => 'required',
            'hinh' => 'required|mimes:jpeg,bmp,png,jpg,gif'
        ],
        [
            'loaitin_id.required' => 'Vui lòng chọn loại tin',
            'tieude.required' => 'Vui lòng nhập tiêu đề',
            'tomtat.required' => 'Vui lòng nhập tóm tắt tin',
            'noidung.required' => 'Vui lòng nhập nội dung tin',
            'hinh.required' => 'Vui lòng chọn file hình',
            'hinh.mimes' => 'File Bạn Chọn Không Được Phép',
            // 'hinh.dimensions' => 'Vui Lòng Chọn Ảnh 825*465'   
        ]);
        if($request->hasFile('hinh')){
        $ext = \File::extension($request->hinh->getClientOriginalName());
        $linkimg = uniqid(). '.' .$ext;
        $tintuc = Tintuc::create([
            'loaitin_id' => $request->loaitin_id,
            'tieude'=> $request->tieude,
            'tieudekhongdau'=> $this->stripUnicode($request->tieude),
            'tomtat' => $request->tomtat,
            'noidung' => $request->noidung,
            'hinh' => $request->hinh->storeAs('uploadTintuc',$linkimg),
            'noibat' => 0,
            'user_id' => Auth::user()->id,
            'soluotxem' => 0,
            'trangthai' => 1,
            'tinnong' => 0
        ]);
        return redirect()->route('tintuc.index.public');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\tintuc  $tintuc
     * @return \Illuminate\Http\Response
     */
    public function show(tintuc $tintuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tintuc  $tintuc
     * @return \Illuminate\Http\Response
     */
    public function edit(tintuc $tintuc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tintuc  $tintuc
     * @return \Illuminate\Http\Response
     */
    public function getUpdate($id)
    {
        $tintuc = Tintuc::findOrFail($id);
        $loaitins = Loaitin::all();
        return view('admin.tintuc.update',compact('tintuc','loaitins'));
    }
    public function update(Request $request, $id) //chỉnh sửa tin tức
    {
        $request->validate([
            'loaitin_id' => 'required',
            'tieude' => 'required',
            'tomtat' => 'required',
            'noidung' => 'required',
            'hinh' => 'mimes:jpeg,bmp,png,jpg,gif'
        ],
        [
            'loaitin_id.required' => 'Vui lòng chọn loại tin',
            'tieude.required' => 'Vui lòng nhập tiêu đề',
            'tomtat.required' => 'Vui lòng nhập tóm tắt tin',
            'noidung.required' => 'Vui lòng nhập nội dung tin',
            'hinh.mimes' => 'File Bạn Chọn Không Được Phép',
            // 'hinh.dimensions' => 'Vui Lòng Chọn Ảnh 825*465'       
        ]);
        
            $tintuc = Tintuc::findOrFail($id);
            $tintuc->loaitin_id = $request->loaitin_id;
            $tintuc->tieude = $request->tieude;
            $tintuc->tieudekhongdau = $this->stripUnicode($request->tieude);
            $tintuc->tomtat = $request->tomtat;
            $tintuc->noidung = $request->noidung;
        if($request->hasFile('hinh')){
            $ext = \File::extension($request->hinh->getClientOriginalName());
            $linkimg = uniqid(). '.' .$ext;
            $tintuc->hinh = $request->hinh->storeAs('uploadTintuc',$linkimg);
        }
            $tintuc->user_id = Auth::user()->id;
            $tintuc->soluotxem = 0;
            $tintuc->trangthai = $request->trangthai;
            $tintuc->save();
            return redirect()->route('tintuc.index.public');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tintuc  $tintuc
     * @return \Illuminate\Http\Response
     */
    public function destroypublic($id)
    {
        $tintuc = Tintuc::findOrFail($id);
        $tintuc->delete();
        return redirect()->route('tintuc.index.public');
    }
    public function destroyprivate($id)
    {
        $tintuc = Tintuc::findOrFail($id);
        $tintuc->delete();
        return redirect()->route('tintuc.index.private');
    }
}
