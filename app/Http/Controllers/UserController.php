<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('level','<>',2)->get();
        return view('admin.user.user',compact('users'));
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
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'avatar' => 'required',
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password'
        ],
        [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Tên không vượt quá 50 kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng là email',
            'email.unique' => 'Email đã tồn tại',
            'avatar.required' => 'Vui tải file avatar của bạn lên',
            'password.required' => 'Vui lòng nhập password',
            'password.min' => 'Password phải có ít nhất 6 kí tự',
            'passwordAgain.required' => 'Vui lòng nhập nhắc lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu và mật khẩu nhắc lại không trùng khớp'
        ]);
        if($request->hasFile('avatar')){
        $ext = \File::extension($request->avatar->getClientOriginalName());
        $linkimg = uniqid(). '.' .$ext;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $request->avatar->storeAs('uploadUser',$linkimg),
            'password' => Hash::make($request->password),
            'level' => 1,
            'active' => 1,
            'verifytoken' => str_random(40)
        ]);
        return redirect()->route('user.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
