<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Slide;
use App\Theloai;
use App\Loaitin;
use App\Tintuc;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        $menus = Theloai::all();
        $tintucs = Tintuc::all();
        $tinnoibat = Tintuc::where('noibat',1)->where('trangthai',1)->get();
        $hots = Tintuc::where('tinnong',1)->where('trangthai',1)->take(6)->orderBy('created_at', 'desc')->get();
        $newposts = Tintuc::where('trangthai',1)->orderBy('created_at', 'desc')->take(6)->get();
        return view('index',compact('menus','slides','tinnoibat','hots','newposts','tintucs'));
    }
    public function get_Title_Slide()
    {
        $title = Tintuc::where('trangthai',1)->take(4)->orderBy('created_at', 'desc')->get();
        $title = $title->toArray();
        $posts = [];
        foreach ($title as $value) {
            $value["link"] = route('index.pagechitiet',['id'=>$value['id'],'tieude'=>$value['tieude']]);
            array_push($posts, $value);
        }
        return $posts;
    }
    public function search(Request $request){ //search ở header
        $request->validate([
            'keyword' => 'required'
        ],[
            'keyword.required' => 'Vui lòng nhập tiêu đề tin cần tìm'
        ]);
        $slides = Slide::all();
        $menus = Theloai::all();
        $keyword = $request->keyword;
        $searchs = Tintuc::where('tieude','like', '%'.$keyword.'%')->where('trangthai',1)->get();
        $hots = Tintuc::where('tinnong',1)->take(5)->get();
        return view('index', compact('searchs','slides','menus'));
    }
    public function liveSearch(Request $request){ //live search ở header
        // Mảng lưu tin tức
        $list_search = [];
        // Tìm tất cả các bài viết có gần giosogn tên
        $searchs = Tintuc::where('tieude','like', '%'.$request->txt.'%')->where('trangthai',1)->get()->toArray();
        foreach ($searchs as $key => $value) {
            // Thêm 1 thuộc tính "link" cho nó.
            $value["link"] = route('index.pagechitiet',['id'=> $value["id"],'tieude'=>$value["tieude"]]);
            // Thêm vào mảng lưu tin tức.
            array_push($list_search, $value);
        }
        return $list_search;
            // }
    }
    public function getSign_up(){ //lấy view đăng kí
        return view('users.sign_up');
    }
    public function checkEmail(Request $request){ //kiểm tra email đã tồn tại chưa
        $email = User::where('email',$request->email)->first();
        if (isset($email)) {
            return 1;
        }
        else 
            return 0;
    }
    public function postSign_up(Request $request){ //đăng kí
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'avatar' => 'required|mimes:jpeg,bmp,png,jpg,gif',
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
        // var_dump($request->avatar);
        if($request->hasFile('avatar')){
            $ext = \File::extension($request->avatar->getClientOriginalName());
            $linkimg = uniqid(). '.' .$ext;
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $request->avatar->storeAs('uploadUser',$linkimg),
                'password' => Hash::make($request->password),
                'level' => 0,
                'active' => 1,
                'verifytoken' => str_random(40)
            ]);
            return 1;  
        }
        return 0;     
    }
    public function getSign_in(){ //lấy view đăng nhập
        if (Auth::check()) {
            return redirect()->route('index');
        }
        else
        {
            return view('login');
        }
        
    }
    public function postSign_in(Request $request){ //đăng nhập
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.exists' => 'Email không tồn tại',
            'password.required' => 'Vui lòng nhập password'
        ]);
    if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'active'=> 1], $request->remember))
        {
            $user = Auth::user();
            if($user->level == 2)
            {
                return redirect()->route('admin.index');
            }
            else if($user->level == 1)
            {
                return redirect()->route('ctv.index');
            }
            else
                return redirect()->route('index');
        }
    else
        {
            return view('login');
        }
    }
    public function getLogout(){ //logout
        Auth::logout();
        return redirect()->route('index');
    }
    public function getForgotpassword(){
        return view('users.forgotpassword');
    }
    public function sendMail(Request $request){
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ],
            [
                'email.required' => 'Vui lòng nhập email tài khoản của bạn',
                'email.email' => 'Vui lòng nhập đúng email',
                'email.exists' => 'Không tồn tại email này'
            ]);
        $u = User::where('email',$request->email)->first();
        if($u)
        {
            $user = User::where('email',$request->email)->first();
            if ($user) {
                Mail::send('users.emailforgotpass',['user' => $user], function ($message) use ($user) {
                    $message->from('admin@gmail.com', 'Quản trị viên');
                    $message->to($user->email);
                    $message->subject('Email nhận lại mật khẩu');      
                }); 
                return 1;
            }
            
        }
        else
            return 0;
    }
    public function getviewChangepassword(){
        return view('users.changepassword');
    }
    public function Changepassword(Request $request,$token,$id){
        // dd($token);
        $user = User::where('id',$id)->where('verifytoken',$token)->first();
        if($user)
        {
            $request->validate([
                'password' => 'required|min:6',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'password.required' => 'Vui lòng nhập password',
                'password.min' => 'Password phải có ít nhất 6 kí tự',
                'passwordAgain.required' => 'Vui lòng nhập nhắc lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu và mật khẩu nhắc lại không trùng khớp'
            ]);
            $user->password = Hash::make($request->password);
            $user->verifytoken = str_random(40);
            return 1;     
        }
        else
            return 0;
    }
    public function getviewChangeavatar(){
        return view('users.changeavatar');
    }
    public function Changeavatar(Request $request)
    {
        $user = Auth::user();
        $request->validate(
            [
               'avatar' => 'required|mimes:jpeg,bmp,png,jpg,gif' 
            ],
            [
                'avatar.required' => 'Vui tải file avatar của bạn lên',
                'avatar.mimes' => 'Vui lòng chọn đúng định dạng ảnh'
            ]);
        if($request->hasFile('avatar')){
            $ext = \File::extension($request->avatar->getClientOriginalName());
            $linkimg = uniqid(). '.' .$ext;
            $user->avatar = $request->avatar->storeAs('uploadUser',$linkimg);
            $user->save();
            return 1;  
        }
        return 0;
    }
    public function viewChangepass_user()
    {
        return view('users.changepassword_user');
    }
    public function Changepass_user(Request $request)
    {
        $request->validate(
            [
                'oldpassword' => 'required',
                'password' => 'required|min:6',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'oldpassword.required' => 'Vui lòng nhập mật khẩu cũ',
                'password.required' => 'Vui lòng nhập password mới',
                'password.min' => 'Password phải có ít nhất 6 kí tự',
                'passwordAgain.required' => 'Vui lòng nhập nhắc lại mật khẩu mới',
                'passwordAgain.same' => 'Mật khẩu mới và mật khẩu nhắc lại không trùng khớp'
            ]);
        if(Hash::check($request->oldpassword, Auth::user()->password))
            {
                // dd($request->password,$request->oldpassword);
                $request->validate([
                    'oldpassword' => 'required',
                    'password' => 'different:oldpassword'
                ],
                [
                    'password.different' => 'Mật khẩu mới không được giống mật khẩu cũ'
                ]);
                $user = Auth::user();
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('get.logout');
            }
        else
        {
            $request->session()->flash('status', 'Mật khẩu cũ không chính xác');
            return view('users.changepassword_user');
        }
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
