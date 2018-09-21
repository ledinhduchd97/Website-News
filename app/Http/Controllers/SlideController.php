<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;


class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slide.slide',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStore(){
        return view('admin.slide');
    }
    public function store(Request $request)
    { 
        $request->validate(
        [
            'ten' => 'required|unique:slides',
            'link' => 'required|mimes:jpeg,bmp,png,jpg,gif|dimensions:min_width=799,max_min_width=801,min_height=299,max_height=801'
        ],
        [
            'ten.required' => 'Vui Lòng Nhập Tên Cho Ảnh',
            'ten.unique' => 'Tên Này Đã Tồn Tại',
            'link.required' => 'Vui Lòng Chọn Ảnh',
            'link.mimes' => 'Vui lòng chọn đúng định dạng ảnh',
            'link.dimensions' => 'Vui Lòng Chọn Ảnh 800*300'
        ]);  
        if($request->hasFile('link')){
        $ext = \File::extension($request->link->getClientOriginalName());
        $linkimg = uniqid(). '.' .$ext;
        $slides = Slide::create([
            'ten' => $request->ten,
            'link' => $request->link->storeAs('uploadSile',$linkimg)
        ]);
        return redirect()->route('slide.index');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, slide $slide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();
        return redirect()->route('slide.index');
    }
}
