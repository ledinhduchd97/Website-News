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
use App\Comment;

class PageChitietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $tintuc = Tintuc::findOrFail($id);
        $comments = Comment::where('tintuc_id',$id)->get();
        $tintucnoibats = Tintuc::where('noibat',1)->where('id','<>',$id)->orderBy('created_at', 'desc')->take(5)->get();
        $tintuclienquans = Tintuc::where('loaitin_id',$tintuc->loaitin_id)->where('id','<>',$id)->orderBy('created_at', 'desc')->take(5)->get();
        $value = session($tintuc->soluotxem++);
        $tintuc->save();
        return view('chitiet',compact('tintuc','comments','tintucnoibats','tintuclienquans'));
    }
    public function comment(Request $request,$id)
    {
        if(Auth::check()) //Đăng nhập mới cho bình luận
        {
            $request->validate([
                'content' => 'required'
            ],
            [
                'content.required' => 'Vui lòng nhập nội dung bình luận'
            ]);
            $comment = Comment::create([
                'user_id' => Auth::user()->id,
                'tintuc_id' => $id,
                'content' => $request->content
            ]);
            return response()->json([
                'data' => $comment,
                'user' => Auth::user(),
                'linkdelete' => route('del.comment.pagechitiet',['id'=> $comment->id])
            ]);
        }
        else
        {   
            return 1;           
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
    // public function delete_comment($id)
    // {
    //     var_dump($id);
    //     if (Auth::check()) {
    //         $comment = Comment::findOrFail($id);
    //         if ($comment->isAuth()) {
    //             $idpost = $comment->tintuccmt->id;
    //             $comment->delete();
    //             return redirect()->route('index.pagechitiet',['id' => $idpost, 'tieude'=> $comment->tintuccmt->tieude]);
    //         }
    //         return 2;
    //     }
    //     else
    //     {
    //         return 1;
    //     }  
    // }
    public function delete_comment($id)
    {
        if (Auth::check()) {
            $comment = Comment::findOrFail($id);
            if ($comment->user->id == Auth::id()) {
                $comment->delete();
                return redirect()->route('index.pagechitiet',['id'=> $comment->tintuccmt->id,'tieude'=>$comment->tintuccmt->tieude]); 
            }
            else
                return 2;
              
        }
        else
            return 1; 
    }
}
